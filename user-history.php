<?php
//获取用户权限
    require_once("session.php");
    
    require_once("class.user.php");
    $auth_user = new USER();
    
    
    $user_id = $_SESSION['user_session'];
    
    $stmt = $auth_user->runQuery("SELECT * FROM reader WHERE user_id=:user_id");
    $stmt->execute(array(":user_id"=>$user_id));
    
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

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

<!-- jquery -->
<script src="https://cdn.bootcss.com/jquery/2.2.3/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<!-- bootstrap-table.min.js -->
<script src="https://cdn.bootcss.com/bootstrap-table/1.11.1/bootstrap-table.min.js"></script>
<!-- 引入中文语言包 -->
<script src="https://cdn.bootcss.com/bootstrap-table/1.11.1/locale/bootstrap-table-zh-CN.min.js"></script>
    
<link rel="stylesheet" href="css/jPages.css">
<script src="js/jPages.min.js"></script>
    
</head>
<body>
    <div class="navbar navbar-duomi navbar-static-top" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <div class="navbar-brand" id="logo">图书管理系统</div>
                    </div>
                    <div class="nav-information">
                         <!--+信息--> 
                         <span class="glyphicon glyphicon-user"></span>&nbsp;你好，<?php echo $userRow['user_name']; ?>&nbsp;</a>
                         <a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;退出</a>
                    </div>
                </div>
    </div>
    
    <div class="container-fluid" style="min-height: 680px;">
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

                            <li>
                                <a href="./search-book.php">
                                    <i class="glyphicon glyphicon-search"></i>
                                    图书搜索
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
                                        <tbody  id="itemContainer">  
                                            <?php
                                         $user_id = $userRow['user_id'];
                                        $dbc = mysqli_connect('localhost','root','','book_manager');
                                        $query = "SELECT * FROM user_record WHERE return_time IS NOT NULL AND user_id ='$user_id'";
                                        $result = mysqli_query($dbc,$query) or die("error quering database". mysqli_error($dbc));
                                        
                                        echo "<div class='holder'></div>";

                                        while ($row = mysqli_fetch_array($result)) 
                                        {
        
                                            echo '<tr>';
                                            echo '<td>' . $row['book_name'] .  '</td>';
                                            echo '<td>' . $row['book_id'] .  '</td>';
                                            echo '<td>' . $row['ISBN'] .  '</td>';
                                            echo '<td>' . $row['borrow_time'] .  '</td>';
                                            echo '<td>' . $row['return_time'] .  '</td>';

                                            echo '</tr>';
                                        }
                                        ?>

                                        </tbody>  
                                </table>
                            </div>  
                    </div>                      
                </div>
    </div>
    <div class="copyright" style="
    background-color: #ccc;
    text-align: center;
    height: 30px;
    padding-top: 5px;">TEAM1 版权所有©2018 技术支持电话：000-00000000</div>
    </body>
    
<script>
$(document).ready(function () {
$("div.holder").jPages({
containerID: "itemContainer",
first: '首页',//false为不显示
previous: '上一页',//false为不显示
next: '下一页',//false为不显示 自定义按钮
last: '尾页',//false为不显示
perPage: 5,
keyBrowse: true,
scrollBrowse: true
});
});
</script>
