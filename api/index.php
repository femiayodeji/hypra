<?php
// header("Access-Control-Allow-Origin: *");
// header('Access-Control-Allow-Headers: Authorization');
require_once('./config/Routes.php');

function __autoload($class_name){
	if(file_exists('./config/'.$class_name.'.php')){
		require_once './config/'.$class_name.'.php';
	}
	elseif(file_exists('./Controllers/'.$class_name.'.php')){
		require_once './Controllers/'.$class_name.'.php';
	}
}

?>
