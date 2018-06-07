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
</head>
<body>
    <div class="navbar navbar-duomi navbar-static-top" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="/Admin/index.html" id="logo">
                            图书管理系统
                        </a>
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
        
                            <li>
                                <a href="./change-person.php">
                                    <i class="glyphicon glyphicon-globe"></i>
                                    管理用户信息
                                    <span class="label label-warning pull-right">5</span>
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
                                                <tbody>  
                                                <tr>';
                                             while ($row = mysqli_fetch_array($result)){    
                                              echo '<td>'.$row['user_name'] .'</td>';
                                              echo '<td>'.$row['user_id'] .'</td>';
                                              echo '<td>'.$row['register_day'] .'</td>';
                                              echo '<td>';
                                              if($row['user_state']=='1'){
                                                echo '<td><a class="btn btn-danger" href="state/forbidden.php?user_id='.$row['user_id'].'">禁用</a></td>';
                                              }
                                              else{
                                                echo "代建按钮";
                                              }
                                              echo '</td></tr></tbody> '; 
                                          }}

                                        ?>
                                    
                            </table>
                        </div>
                    </div>
                </div>
    </div>
    
</body>
</html>