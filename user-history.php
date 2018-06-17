<?php
  session_start();
    require_once("session.php");
    
    require_once("class.user.php");
    $auth_user = new USER();
    
    
    $user_id = $_SESSION['user_session'];
    
    $stmt = $auth_user->runQuery("SELECT * FROM reader WHERE user_id=:user_id");
    $stmt->execute(array(":user_id"=>$user_id));
    
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    
    error_reporting(0);

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>图书管理系统-个人借阅状态</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css"  href="css/user.css"/>
    <link rel="stylesheet" type="text/css"  href="css/bootstrap.css" />
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- 引入bootstrap样式 -->
<link href="https://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<!-- 引入bootstrap-table样式 -->
<link href="https://cdn.bootcss.com/bootstrap-table/1.11.1/bootstrap-table.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css"  href="css/nav.css" />

<!-- jquery -->
<script src="https://cdn.bootcss.com/jquery/2.2.3/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<!-- bootstrap-table.min.js -->
<script src="https://cdn.bootcss.com/bootstrap-table/1.11.1/bootstrap-table.min.js"></script>
<!-- 引入中文语言包 -->
<script src="https://cdn.bootcss.com/bootstrap-table/1.11.1/locale/bootstrap-table-zh-CN.min.js"></script>
</head>
<body>
    <div class="navbar navbar-duomi navbar-static-top" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="/Admin/index.html" id="logo">图书管理系统
                        </a>
                    </div>

                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle navbar-brand2" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['user_name']; ?>&nbsp;<span class="caret"></span>
                                </a>
                                 <ul class="dropdown-menu">
                                    <li><a href="search-book.php"><span class="glyphicon glyphicon-search"></span>&nbsp;查找图书</a></li>
                                    <li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;退出登录</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </div>

    </div>
    
    <div class="container-fluid">
                <div class="row">
                    <div id="nav-up" class="col-md-2">
                        <ul id="main-nav" class="nav nav-tabs nav-stacked" >
                            <li class="active">
                                <a href="#">
                                    <i class="glyphicon glyphicon-th-large"></i>
                                图书管理系统         
                                </a>
                            </li>

                            <li>
                                <a href="./user-approval.php" >
                                    <i class="glyphicon glyphicon-cog"></i>
                                    审批状态
                                   
                                </a>
                            </li>

                            <li>
                                <a href="./user-borrow.php">
                                    <i class="glyphicon glyphicon-credit-card"></i>
                                    当前借阅        
                                </a>
                            </li>
        
                            <li class="change">
                                <a href="./user-history.php">
                                    <i class="glyphicon glyphicon-globe"></i>
                                    借阅历史
                                </a>
                            </li>
        
                        </ul>
                    </div>

                    <div class="col-md-10">
                            <div class="history">
                                    <fieldset>
                                            <legend>借阅历史</legend>
                                    </fieldset>
                                <table class="table table-striped table-hover table-responsive">  
                                        <thead>  
                                            <tr>
                                                <th>书名</th>
                                                <th>编号</th>
                                                <th>ISBN</th>
                                                <th>借阅时间</th>
                                                <th>归还时间</th>
                                            </tr>  
                                        </thead>  
                                        <tbody>  
                                            <?php

                                       
                                        $dbc = mysqli_connect('localhost','root','','book_manager');
                                        $query = "SELECT * FROM apply WHERE apply_type = 'return' and approval_state = 'agree' and user_id='$user_id'
                                        ";
                                        $result = mysqli_query($dbc,$query) or die("error quering database". mysqli_error($dbc));


                                        while ($row = mysqli_fetch_array($result)) 
                                        {
        
                                            echo '<tr>';
                                            echo '<td>' . $row['book_name'] .  '</td>';
                                            echo '<td>' . $row['book_id'] .  '</td>';
                                            echo '<td>' . $row['ISBN'] .  '</td>';
                                            echo '<td>' . $row['apply_time'] .  '</td>';
                                            echo '<td>' . $row['operate_time'] .  '</td>';

                                            echo '</tr>';
                                        }
                                        ?>

                                        </tbody>  
                                </table>
                            </div>  
                    </div>

                   
                        

                </div>
    </div>
