<?php

class MobileController extends Controller{
	public function Index(){
		get(function(){
			$arr = array("name" => "Josiah", "age" => 68, "email" => "mighty@mail.com");
			json($arr);
		});
	}
	public function here(){
		post(function(){
			json($out);
		});
	}
}

?>