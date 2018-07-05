<?php
class DbContext{
	public static $host = "localhost";
	public static $database = "edu-virel";
	public static $user = "root";
	public static $password = "";

	public function __construct(){
	}

	public function connect(){
		try{
			//connect to db
	 		$dns = "mysql:host=".self::$host.";dbname=".self::$database;
			$pdo = new PDO($dns,self::$user,self::$password);
			$data = array("status"=> true,"pdo" => $pdo);	
			return $data;
		}
		catch(PDOException $e){
			$error = array("status"=> false,"message" => $e->getMessage());	
			return $error;
		}
	}

	public function query($query,$params = array()){
		if(self::connect()['status']){
			$statement = self::connect()['pdo']->prepare($query);		
			if($statement->execute($params)){
				$query_keyword = explode(' ', $query);
				if($query_keyword[0] == 'SELECT'){
					$data = $statement->fetchAll(FetchType);
					if($statement->rowCount() < 1){
						$data = array("status"=> true,"message" => "No record found");							
					}
					else{
						$data = array("status"=> true,"message" => "successful","data" => $data);							
					}						
				}
				elseif($query_keyword[0] == 'UPDATE'){
					if($statement->rowCount() < 1){
						$data = array("status"=> true,"message" => "No change made");							
					}
					else{
						$data = array("status"=> true,"message" => "successful");							
					}						
				}
				else{
					if($statement->rowCount() < 1){
						$data = array("status"=> true,"message" => "No record hit");							
					}
					else{
						$data = array("status"=> true,"message" => "successful");							
					}						
				}
			}
			else{
				$data = array("status"=> false,"message" => "Failed");			
			}
			return $data;
		}
		else{
			return self::connect();
		}
	}

}
?>