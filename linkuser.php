<?php
  class Linkuser {

  	public $username;
	  public $password;

  	public function __construct(){
  		$this->username = $_POST['username'];
  		$this->password = $_POST['password'];
  	}
	function jump(){
            if($this->username=="666"){
            	header("Location:change-book.html");
            }elseif($this->username=="1234"){
            	header("Location:user-approval.html");
            }
    }
 }