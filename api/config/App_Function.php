<?php

//I'll like to get the name of method in order to reduce the code
//request method/verb
function get($function){
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		$function->__invoke();
	}
	else{
		$data = array("status"=> false,"message" => "Undefined route. Gerarahere!");
		json($data);
	}
}

function post($function){
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$function->__invoke();
	}
	else{
		$data = array("status"=> false,"message" => "Undefined route. Gerarahere!");
		json($data);
	}
}

function put($function){
	if($_SERVER['REQUEST_METHOD'] == "PUT"){
		$function->__invoke();
	}
	else{
		$data = array("status"=> false,"message" => "Undefined route. Gerarahere!");
		json($data);
	}
}

function delete($function){
	if($_SERVER['REQUEST_METHOD'] == "DELETE"){
		$function->__invoke();
	}
	else{
		$data = array("status"=> false,"message" => "Undefined route. Gerarahere!" );
		json($data);
	}
}

//globally unique identifier
function guid()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return strtolower(sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535)));
}

//cryptography
function password_encrypt($password){
	$hash_format="$2y$10$";
	$salt_length=22;
	$salt=generate_salt($salt_length);
	$format_and_salt = $hash_format . $salt;
	$hash=crypt($password,$format_and_salt);
	return $hash;
}
function password_check($try_password, $password){
	$hash=crypt($try_password, $password);
	if($hash === $password){
		return true;
	}
	else{
		return false;
	}
}
function generate_salt($salt_length){
	$unique_random_string=md5(uniqid(mt_rand(), true));
	$base64_string=base64_encode($unique_random_string);
	$modified_base64_string=str_replace('+','.',$base64_string);
	$modified_base64_string=str_replace('+','.',$base64_string);
	$salt=substr($modified_base64_string, 0, $salt_length);
	return $salt;
}

//refactorization of input
function model(){
	$parameters = file_get_contents('php://input');
	$parameters = json_decode($parameters);
	$permitteduser = array();
	foreach($parameters as $parameter_name => $parameter_value) {
		$permitteduser[$parameter_name] = $parameter_value;
	}
	return $permitteduser;
}

//Account security
function verify($user){
}
function validate($user,$component){
	switch (strtolower($component)) {
		case 'login':
			login($user);
			break;
		case 'register':
			register($user);
			break;
		default:
			json(array("status"=> false,"message" => "Invalid component"));
			break;
	}
}

function register($user){
	if(!empty($user['email']) && !empty($user['password']) && !empty($user['username'])){

		$password = password_encrypt($user['password']);
		//restrict used email
		$isEmailUnique = AccountController::isEmailUnique($user['email']);
		$isUsernameUnique = AccountController::isUsernameUnique($user['username']);
		if($isEmailUnique){
			if($isUsernameUnique){
				$id = guid();
				$result = AccountController::query("INSERT INTO `appuser` SET uid=?, username=?, password=?, email=?",[$id,$user['username'],$password,$user['email']]);
				json($result);
			}
			else{
				json(array("status"=> false,"message" => "Username is in used"));
			}
		}
		else{
			json(array("status"=> false,"message" => "Email is in use"));
		}
	}
	else{
		json(array("status"=> false,"message" => "All fields required"));
	}
}
function login($user){
	$result = DbContext::query("SELECT * FROM appuser WHERE email=?",[$user['email']]);
	if($result['status']){
		$result = $result['data'][0];
		//verify password
		$isPassword = password_check($user['password'], $result['password']);
		if($isPassword){
			//adding claims
			//user and details
			$id = $result['id'];
			$uid = $result['uid'];
			$email = $result['email'];
			$username = $result['username'];
			$claims = array('id'=> $id, 'uid'=> $uid, 'email'=>$email, 'username'=>$username);
	
			$token = JWT::JWT_encode(json_encode($claims));
			$data = array("status"=> true,"message" => "Valid user","jwt" => $token);
		}
		else{
			$data = array("status"=> false,"message" => "Invalid user");
		}
	}
	else{
		$data = array("status"=> false,"message" => "Invalid user");
	}
	json($data);
}
function startRecovery($user){

	$email = $user["email"];
	$code = md5(mt_rand());
	//check if email exist
	$isEmailUnique = AccountController::isEmailUnique($email);
	if(!$isEmailUnique){
		$id = guid();
		$query = AccountController::query("INSERT INTO accountrecovery SET uid=?, email=?, code=?",[$id,$email,$code]);
		if($query['status']){
			//send email
			$host = SiteHost;
			$link = "<a href='$host/Forgot/$code'>Reset Account Password</a>";
			$email_msg = "Recover Account by clicking the link that follows. Please Ignore if you're not the one who initiated this account recovery. $link";
			Mailer($email,"UI Alumni Account Recovery",$email_msg);
			json(array("status"=> true,"message" => $query['message'], "data" => "Recovery link has been sent to your email."));
		}
		else{
			json(array("status"=> false,"message" => $query['message'],"data" => $query));
		}
	}
	else{
		json(array("status"=> false,"message" => "Email doesn't exist"));
	}
}
function authorizeRecovery($recovery){
	$result = AccountController::query("SELECT id,code,email FROM accountrecovery WHERE used='false' AND code=?",[$recovery['code']]);
	//check for permission to reset password
	if($result['status'] && !empty($result) && $result != null){
		//verify user email
		$user = AccountController::query("SELECT id,username,email FROM user WHERE email=?",[$result['email']]);
		if($user['status'] && !empty($user) && $user != null){
			$token = JWT::JWT_encode(json_encode($user));
			$result = array("status"=> true,"message" => "Authorized to reset password","data" => $token);
		}
		else{
			$result = array("status"=> false,"message" => "Email has been compromised");
		}
	}
	else{
		$result = array("status"=> false,"message" => "Denied permission to reset password");
	}
	json($result);
}
//Identity
function getId(){
	return Authentication::getId();
}

function auth($function){
	if(Authentication::auth()['status']){
		return $function->__invoke();
	}
	else{
		json(Authentication::auth()['message']);
		exit();
	}
}

//other methods
function json($content){
	header("Content-type:application/json");
	echo json_encode($content);
}
function redirect($location){
	echo"<meta http-equiv='refresh' content='0; url=$location'>";
	// exit();
}

//file Handling
function fileHandler($name,$file_name,$path){
	$status=false;
	$messages = array();
	$fileInfo = array();
	$extension= strtolower(pathinfo($_FILES[$name]['name'],PATHINFO_EXTENSION));
	$extensions = array("jpg","jpeg","png","gif","txt", "xlsx");
	$extensionsAsString = implode(", ", $extensions);
	if(!empty($_FILES[$name]['name'])){
		if(!in_array($extension,$extensions))
		{
			array_push($messages," File format must be $extensionsAsString - $extension");
		}	
		if($_FILES[$name]['size'] > 2100000 && $_FILES[$name]['size'] < 100){
			array_push($messages," File size must be between 0.01MB and 2MB");
		}
		
		if(empty($messages)){
			define ("FILEDIRECTORY",$path);
			$file_name=$file_name.'.'.$extension;
			$moveFile = move_uploaded_file($_FILES[$name]['tmp_name'],FILEDIRECTORY."$file_name");
			// var_dump($moveFile);
			if($moveFile){
				$status=true;
				array_push($messages," File successfully uploaded");
				$fileInfo['name'] = $file_name;
				$fileInfo['path'] = $path.$file_name;
			}
			else{
				$status=false;
				array_push($messages," Failed to store file");
			}
		}		
	}
	else if(empty($post_file_name)){
		$status=false;
		array_push($messages,"Empty file.");
	}
	return array('status'=>$status,'fileInfo'=>$fileInfo,'message'=>$messages);
}

//Error handling
function customError($errno, $errstr) {
  echo "<b>Error:</b> [$errno] $errstr<br>";
  die();
}

//mail
function Mailer($to,$subject,$msg){
	$message = "
	<html>
	<head>
	<title>HTML email</title>
	</head>
	<body>
	<div>
	$msg
	</div>
	</body>
	</html>
	";

	// content-type
	$headers = "MIME-Version: 1.0"."\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	$headers .= 'From: <support@advance.ui.edu.ng>'."\r\n";
	$headers .= 'Cc: hello@advance.ui.edu.ng' . "\r\n";

	mail($to,$subject,$message,$headers);
}
?>
