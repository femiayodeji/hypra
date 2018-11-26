<?php

class UserController extends Controller{
	public function Index(){
		get(function(){
			$arr = [array("name" => "instincts", "age" => 25, "email" => "instincts@gmail.com"),array("name" => "test", "age" => 50, "email" => "test@gmail.com"),array("name" => "example", "age" => 100, "email" => "example@gmail.com"),array("name" => "abc", "age" => 12, "email" => "abc@gmail.com")];
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