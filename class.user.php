<?php

require_once('dbconfig.php');

class USER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function register($uname,$upass)
	{
		try
		{
			$new_password = password_hash($upass, PASSWORD_DEFAULT);
			
			$stmt = $this->conn->prepare("INSERT INTO reader(user_name,password) 
		                                               VALUES(:uname, :upass)");
												  
			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":upass", $new_password);										  
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	
	public function doLogin($user_name,$password)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT user_id, user_name, password FROM reader WHERE user_name=:user_name ");
			$stmt->execute(array(':user_name'=>$user_name));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
         
			if($stmt->rowCount() == 1)
			{
				

				if(password_verify($password,$userRow['password']))
				{
					echo "<br>valid<br>";
					$_SESSION['user_session'] = $userRow['user_id'];
					return true;
				}
				else
				{

					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function doLogout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}
}
?>