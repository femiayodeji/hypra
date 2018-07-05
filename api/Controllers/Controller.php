<?php
require_once('./config/App_Constant.php');
require_once('./config/App_Function.php');

class Controller extends DbContext{

	public function CreateView($viewName){
		$controller = Request::getController();
		$controller = str_replace('Controller','',$controller);
		require_once("Views/$controller/$viewName.php");
	}

}
?>