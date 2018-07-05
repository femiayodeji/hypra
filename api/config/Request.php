<?php
// header("Access-Control-Allow-Origin: *");
require_once('./config/App_Constant.php');
require_once('./config/App_Function.php');

class Request{
	public static $validRoutes = array();
	public static $controller;
	public static $method;
	public static $option;

	public function set($route, $function){
		self::$validRoutes[] = $route;
		if(strtolower($_GET['url']) == "index.php"){
			self::$controller = "HomeController";
		}
		else{
			self::$controller = $_GET['url']."Controller";
		}

		$url = trim($_SERVER['REQUEST_URI'],"/");
		$url_elements = explode("/", trim($url));
		$length = count($url_elements);

		self::$method = "Index";
		self::$option = "";
		switch ($length){
			case 3:
				self::$controller = ucfirst($url_elements[2])."Controller";
				break;
			case 4:
				self::$controller = ucfirst($url_elements[2])."Controller";
				self::$method = ucfirst($url_elements[3]);
				break;
			case 5:
				self::$controller = ucfirst($url_elements[2])."Controller";
				self::$method = ucfirst($url_elements[3]);
				self::$option = ucfirst($url_elements[4]);
				break;
			default:
				break;
		}

		$controller = str_replace("Controller", "", self::$controller);
		if(strtolower($controller) == strtolower($route)){
			$function->__invoke();
		}
	}

	public function getController(){
		return self::$controller;
	}

	public function getMethod(){
		return self::$method;
	}

	public function getOption(){
		return self::$option;
	}

	public function method(){
		$controller = self::$controller;
		$method = self::$method;
		$option = self::$option;
		if(method_exists($controller,$method)){
			$controller::$method();
		}
		else{
			$controller = str_replace("Controller", "", $controller);
			json(array("status"=> false,"message" => "Oops! There is no such method as '$method' for the '$controller'" ));
			exit();
		}
	}
}
?>
