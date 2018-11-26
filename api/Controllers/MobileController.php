<?php

class MobileController extends Controller{
	public function Index(){
		get(function(){
			$arr = array("name" => "feminstincts", "age" => 25, "email" => "feminstincts@gmail.com");
			json($arr);
		});
	}
	public function here(){
		post(function(){
			json("Hi there");
		});
	}
}

?>