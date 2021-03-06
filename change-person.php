<?php
//获取用户权限
  require_once("admin_session.php");
  
  require_once("class.admin.php");
  $auth_user = new ADMIN();
  
  
  $admin_id = $_SESSION['admin_session'];
  
  $stmt = $auth_user->runQuery("SELECT * FROM admin WHERE admin_id=:admin_id");
  $stmt->execute(array(":admin_id"=>$admin_id));
  
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>图书管理系统-用户信息管理</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css"  href="css/change.css"/>
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
<style>
.btn-default {
    color: #333;
    background-color: #ccc!important;
    border-color: #ccc;
}
.btn-default:hover {
    color: #333;
    background-color: #ccc!important;
    border-color: #ccc;
}
</style>
<body>
    <div class="navbar navbar-duomi navbar-static-top" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <div class="navbar-brand" id="logo">图书管理系统</div>
                    </div>
                    <div class="nav-information">
                        <!--显示用户信息--> 
                        <span class="glyphicon glyphicon-user"></span>&nbsp;你好，<?php echo $userRow['admin_name']; ?>&nbsp;</a>
                        <a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;退出</a>
                    </div>
                </div>
    </div>
    
    <div style="min-height: 680px;"class="container-fluid">
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
                                <a href="./change-book.php">
                                    <i class="glyphicon glyphicon-cog"></i>
                                    书库管理
                                </a>
                            </li>

                            <li>
                                <a href="./change-manage.php">
                                    <i class="glyphicon glyphicon-credit-card"></i>
                                    管理日志
                                    
                                </a>
                            </li>
        
                            <li class="change">
                                <a href="./change-person.php">
                                    <i class="glyphicon glyphicon-globe"></i>
                                    管理用户信息
                                </a>
                            </li>
        
                        </ul>
                    </div>
                    <div class="col-md-10">
                        <div class="person">
                                <fieldset>
                                        <legend>用户信息</legend>
                                </fieldset>
                            <table class="table table-striped table-hover table-responsive">  
                                    
                                        <?php
                                        $dbc = mysqli_connect('localhost','root','','book_manager');
                                        $query = "SELECT * FROM reader ORDER BY user_id ASC";
                                        $result = mysqli_query($dbc,$query) or die("error quering database". mysqli_error($dbc));
                                         if (!mysqli_num_rows($result)) {
                                            echo '<p>目前暂无用户……</p>';
                                         }
                                         else{
                                             echo '<thead>  
                                                    <tr>
                                                        <th>用户名</th>
                                                        <th>账号</th>
                                                        <th>创建时间</th>
                                                    </tr>  
                                                </thead>  
                                               
                                                <tbody id="itemContainer">  
                                                <tr>';
                                             while ($row = mysqli_fetch_array($result)){    
                                              echo '<td>'.$row['user_name'] .'</td>';
                                              echo '<td>'.$row['user_id'] .'</td>';
                                              echo '<td>'.$row['register_day'] .'</td>';
                                              echo '<td>';
                                              echo '</td></tr> '; 
                                          }}
                                        ?>
                                    </tbody>
                            </table>
<div align="center">
<div class='holder'></div> 
</div>
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
perPage: 10,
keyBrowse: true,
});
});
</script>

</html>
