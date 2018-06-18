<?php
session_start();
require_once("class.admin.php");
$login = new ADMIN();

if(isset($_POST['btn-login']))
{
    $admin_name = strip_tags($_POST['txt_user_name']);
    $password = strip_tags($_POST['txt_password']);
        
    if($login->doLogin($admin_name,$password))
    {
        $login->redirect('change-book.php');
    }
    else
    {
        $error =  "用户名或密码错误 !"  ; 
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
        <div class="login_l_img"><img src="images/login-admin.png" /></div>
        <div class="login">
            <div class="login_logo" style="border-color:#3c4553;"><a href="#"><img src="images/admin-logo.jpg"/></a></div>
            <div class="login_name">
                 <p>管理员登录</p>
            </div>

              <form method="post">
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
                    <button type="submit" name="btn-login" class="login-button" style="width:100%;background-color: #3c4553;">
                         登录
                    </button>
                </div>
            

            </form>

        <!--    <form method="post" >
                <input name="username" type="text" id="username" value="用户名" onfocus="this.value=''" onblur="if(this.value==''){this.value='用户名'}">
                <span id="password_text" onclick="this.style.display='none';document.getElementById('password').style.display='block';document.getElementById('password').focus().select();" >密码</span>
                <input name="password" type="password" id="password" style="display:none;" onblur="if(this.value==''){document.getElementById('password_text').style.display='block';this.style.display='none'};"/>
                <input value="登录" style="width:100%;background-color: #3c4553;" type="submit" id="login">
            </form> 
        -->
            
            <a href="index.php" style="width:100%;     display: inline-block;
    vertical-align: middle;
    padding: 12px 24px;
    margin: 0px;
    margin-top:10px;
    font-size: 16px;
    line-height: 24px;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    cursor: pointer;
    color: #ffffff;
    background-color: #27A9E3;
    border-radius: 3px;
    border: none;
    text-decoration:none; 
    outline: none;">
    <i class="glyphicon glyphicon-log-in"></i> &nbsp;普通用户登录</a>

      
        </div>
        <div class="copyright">TEAM1 版权所有©2018 技术支持电话：000-00000000</div>
  </div>
</body>




</html>