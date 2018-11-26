<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: authorization, content-type, method');
header('Access-Control-Allow-Methods: GET, PUT, DELETE, POST');
Request::set('index.php',function(){
	HomeController::CreateView('Index');
});

Request::set('home',function(){
	Request::method();
});
Request::set('mobile',function(){
	Request::method();
});
Request::set('user',function(){
	Request::method();
});

?>
