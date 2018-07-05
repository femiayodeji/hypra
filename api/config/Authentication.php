<?php
class Authentication{
	public static $requestData = array();

	public function auth(){
		$header = getallheaders();
		if(array_key_exists('Authorization',$header)){
			$auth = explode(" ",$header['Authorization']);
			if(count($auth) == 2){
				$received_token = $auth[1];
				self::$requestData = JWT::JWT_decode($received_token);
				return self::$requestData;
			}
		}
		return array("status"=>false,"message"=>"Authorization is required","data"=>null);
	}

	public function getId(){
		$check = self::auth();
		if($check['status']){
			$data = $check['data'];
			return $data['uid'];
		}
		return null;
	}

	public function getUsername(){
		$check = self::auth();
		if($check['status']){
			$data = $check['data'];
			return $data['username'];
		}
		return null;
	}
}
?>
