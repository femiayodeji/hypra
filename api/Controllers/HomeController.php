<?php

class HomeController extends Controller{
	public function Index(){
		get(function(){
		self::CreateView('Index');
		});
	}
	//READ
	public function Doc(){
		get(function(){
			self::CreateView('Doc');
		});
	}
}

?>