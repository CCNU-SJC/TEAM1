<?php
session_start();
require_once('class.user.php');
$user = new USER();



if(isset($_POST['btn-signup']))
{
	$user_name = strip_tags($_POST['txt_user_name']);
	$password = strip_tags($_POST['txt_password']);	
	
	if($user_name=="")	{
		$error[] = "provide username !";	
	}
	
	else if($password=="")	{
		$error[] = "provide password !";
	}
	else if(strlen($password) < 6){
		$error[] = "Password must be atleast 6 characters";	
	}
	else
	{
		try
		{
			$stmt = $user->runQuery("SELECT user_name FROM reader WHERE user_name=:user_name");
			$stmt->execute(array(':user_name'=>$user_name));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
				
			if($row['user_name']==$user_name) {
				$error[] = "对不起，您的用户名已被注册 !";
			}
			else
			{
				if($user->register($user_name,$password)){	
					$user->redirect('sign-up.php?joined');
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}	
}

?>




<!Doctype html>
<html>
<head>
<title>用户信息注册</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Validation Signup Form Responsive, Login form web template,Flat Pricing tables,Flat Drop downs  Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- fonts -->
<link href="http://fonts.googleapis.com/css?family=Muli:300,400" rel="stylesheet">
<!-- /fonts -->
<!-- css -->
<link href="css/bootstrap.css" rel="stylesheet" type='text/css' media="all" />
<link href="css/signup.css" rel="stylesheet" type='text/css' media="all" />
<!-- /css -->
</head>
<body>
<div class="navbar navbar-duomi navbar-static-top" role="navigation">
        <div class="navbar-header">
            <div class="navbar-brand" id="logo">图书管理系统</div>           
		</div> 
</div>
<h1 class="w3ls">用户注册</h1>
<div class="content" style="min-height: 558px;">
	<div class="content-agileits">

		<form  method="post" class="form-signin" data-toggle="validator" role="form">

		<?php
			if(isset($error))
			{
			 	foreach($error as $error)
			 	{
		?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                     </div>
        <?php
				}
			}
			else if(isset($_GET['joined']))
			{
		?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; 注册成功！ <a href='index.php'>登录</a> 
                 </div>
        <?php
			}
	    ?>

			<div class="form-group agileinfo wthree w3-agileits agile">
				
				<input type="text" class="form-control" name="txt_user_name" id="username" placeholder="请输入用户名"  value="<?php if(isset($error)){echo $user_name;}?>" data-error="请输入您的用户名" required>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group">
				
				<div class="form-inline row">
					<div class="form-group col-sm-6">
						<input type="password" data-minlength="6" class="form-control"  name="txt_password" id="inputPassword" placeholder="请输入6位密码" required>
						<div class="help-block">最少请输入6位密码</div>
					</div>
					<div class="form-group col-sm-6 w3-agile">
						<input type="password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="您的输入不匹配" placeholder="确认输入" required>
						<div class="help-block with-errors"></div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<button type="submit" name="btn-signup" class="btn btn-lg">注册</button>
			</div>
			<div class="text-center alert alert-success">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; 已有账号！ <a href='index.php'>请登录</a> 
            </div>
		</form>
	</div>
</div>
<div class="copyright" style="
    background-color: #ccc;
    text-align: center;
    height: 30px;
    padding-top: 5px;">TEAM1 版权所有©2018 技术支持电话：000-00000000</div>
<!-- js files -->
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/validator.min.js"></script>
<!-- /js files -->
</body>
</html>
