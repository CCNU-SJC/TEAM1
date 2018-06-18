<?php

require_once('dbconfig.php');

class ADMIN
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
			
			$stmt = $this->conn->prepare("INSERT INTO admin(admin_name,password) 
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
	
	
	public function doLogin($admin_name,$password)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT admin_id, admin_name, password FROM admin WHERE admin_name=:admin_name ");
			$stmt->execute(array(':admin_name'=>$admin_name));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
         
			if($stmt->rowCount() == 1)
			{
				

				if(password_verify($password,$userRow['password']))
				{
					echo "<br>valid<br>";
					$_SESSION['admin_session'] = $userRow['admin_id'];
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
		if(isset($_SESSION['admin_session']))
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
		unset($_SESSION['admin_session']);
		return true;
	}
}
?>