<?php
class Error {
	private $id;
	private $status;
	private $message;
	private $details;
	private $date;
	private $creator;

	//constructor
	public function __construct($error)
	{
		$this->setId($error["id"]);
		$this->setStatus($error["status"]);
		$this->setMessage($error["message"]);
	}

	//setter method
	public function setId($id) {
		$this->id = $id;
	}
	public function setStatus($status) {
		$this->status = $status;
	}
	public function setMessage($message) {
		$this->message = $message;
	}

	//getter method
	public function getId()
	{
		return $this->id;
	}
	public function getStatus() {
		return $this->status;
	}
	public function getMessage() {
		return $this->message;
	}
}
?>