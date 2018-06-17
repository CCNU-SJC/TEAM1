<?php
session_start();
require_once("class.user.php");
$login = new USER();



if(isset($_POST['btn-login']))
{
    $user_name = strip_tags($_POST['txt_user_name']);
    $password = strip_tags($_POST['txt_password']);
        
    if($login->doLogin($user_name,$password))
    {
        $login->redirect('user-approval.html');
    }
    else
    {
        $error = "Wrong Details !" ; 
    }   
}
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>图书管理系统登录</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css"  href="css/login.css"/>
    <link rel="stylesheet" type="text/css"  href="css/bootstrap.css" />
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <div class="login_box">
        <div class="login_l_img"><img src="images/login-img.png" /></div>
        <div class="login">
            <div class="login_logo"><a href="#"><img src="images/login_logo.png" /></a></div>
            <div class="login_name">
                 <p>图书管理系统</p>
            </div>
            <form method="post" id="login-form">
                
                <div id="error">
        <?php
            if(isset($error))
            {
                ?>
                <div class="false alert-danger">
                   <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                </div>
                <?php
            }
        ?>
        </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="txt_user_name" placeholder="用户名" required />
                    <span id="check-e"></span>
                </div>
        

                <div class="form-group">
                    <input type="password" class="form-control" name="txt_password" placeholder="密码" />
                </div>
       

                <div class="form-group">
                    <button type="submit" name="btn-login" class="login-button">
                         登录
                    </button>
                </div>

            </form>
            <a href="admin-login.html" style="width:100%;     display: inline-block;
    vertical-align: middle;
    padding: 12px 24px;
    margin: 0px;
    margin-top:-5px;
    font-size: 16px;
    line-height: 24px;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    cursor: pointer;
    color: #ffffff;
    background-color: #3b4650;
    border-radius: 3px;
    border: none;
    text-decoration:none; 
    outline: none;">
    <i class="glyphicon glyphicon-log-in"></i> &nbsp;管理员登录
    </a>
    <label>Don't have account yet ! <a href="sign-up.php">Sign Up</a></label>
        </div>
        <div class="copyright">TEAM1 版权所有©2018 技术支持电话：000-00000000</div>
  </div>
</body>




</html>