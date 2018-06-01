<?php
   class Connection{
   	private $host = "localhost";
   	private $db_name = "book_manager";
   	private $username = "root";
   	private $password = "";

   	public function getConnection(){
     
      $this->conn = null;

      try{
      	$this->conn = new PDO("mysql:host" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        echo "Connected sucessfully";
        }
      catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
   }}
