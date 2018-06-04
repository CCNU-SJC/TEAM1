<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>图书管理系统-管理日志</title>
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
                        <a class="navbar-brand" href="/Admin/index.html" id="logo">图书管理系统
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
                                <a href="./change-book.html" >
                                    <i class="glyphicon glyphicon-cog"></i>
                                    书库管理
                                </a>
                            </li>

                            <li>
                                <a href="./change-manage.html">
                                    <i class="glyphicon glyphicon-credit-card"></i>
                                    管理日志        
                                </a>
                            </li>
        
                            <li>
                                <a href="./change-person.html">
                                    <i class="glyphicon glyphicon-globe"></i>
                                    管理用户信息
                                    <span class="label label-warning pull-right">5</span>
                                </a>
                            </li>
        
                        </ul>
                    </div>
                    <div class="col-md-10">
                        <div class="approval">
                                <fieldset>
                                        <legend>审批状态</legend>
                                </fieldset>
                                <table class="table table-striped table-hover table-responsive">  
                                        

                                            <?php
                                               
                                               $dbc = mysqli_connect('localhost','root','','book_manager');
                                               $query = "SELECT * FROM apply ORDER BY apply_time ASC";
                                               $result = mysqli_query($dbc,$query) or die("error quering database". mysqli_error($dbc));

                                               if (!mysqli_num_rows($result) ){
                                                    echo '<p>目前暂无申请……</p>';
                                                }

                                                else{
                                                     echo '  <thead> 
                                                     <tr>
                                                    <th>用户账号</th>
                                                    <th>申请类型</th>
                                                    <th>图书ID</th>
                                                    <th>ISBN</th>
                                                    <th>申请时间</th>
                                                     </tr>  
                                                    </thead><tbody>  ';
                                                     while ($row = mysqli_fetch_array($result)) {
                                                    echo '<tr>';
                                                    echo '<td>' . $row['user_id'] .  '</td>';
                                                    echo '<td>' ;
                                                        switch ($row['apply_type']) {
                                                            case "1":
                                                                echo "借书";
                                                                break;
                                                            case "2":
                                                                echo "还书";
                                                                break;
                                                            case "3":
                                                                echo  "丢失损毁";  
                                                            }
                                                    echo '</td>';
                                                    echo '<td>' . $row['book_id'] . '</td>';
                                                    echo '<td>' . $row['ISBN'] . '</td>';
                                                    date_default_timezone_set("Asia/Shanghai");
                                                    echo '<td>' . date("Y/m/d h:ia",$row['apply_time']) . '</td>';
                                                    echo '<td>' . $row['reason'] . '</td>';
                                                    echo '<td>';
                                                    if ($row['apply_type'] == 3){
                                                       echo '<input class="btn btn-warning" type="button" value="检查下架" onclick="window.location.href="change_state.php?id='.$row['id'].'" >';
                                                    } 
                                                    else{
                                                       echo '<input class="btn btn-primary" type="button" value="通过" onclick="window.location.href="change_state.php?id='.$row['id'].'">
                                                            <input class="btn btn-danger" type="button" value="不通过" onclick="window.location.href="change_state.php?id='.$row['id'].'">';
                                                    }
                                                    echo '</td>';
                                                    echo '</tr>';
                                                    }}


                                            ?>
    

                                        </tbody>  
                                </table>  
                        </div>
                        <div class="history">
                                <fieldset>
                                        <legend>操作历史</legend>
                                </fieldset>
                            <table class="table table-striped table-hover table-responsive">  


                            <?php
                               
                               $dbc = mysqli_connect('localhost','root','','book_manager');
                               $query = "SELECT * FROM apply WHERE approval_state!='1' ORDER BY apply_time ASC";
                               $result = mysqli_query($dbc,$query) or die("error quering database". mysqli_error($dbc));

                               if (!mysqli_num_rows($result) ){
                                    echo '<p>目前暂无操作历史……</p>';
                                }

                                else{
                                   echo ' <tr>
                                            <th>用户账号</th>
                                            <th>申请类型</th>
                                            <th>图书ID</th>
                                            <th>ISBN</th>
                                            <th>申请时间</th>
                                            <th>操作类型</th>
                                            <th>操作时间</th>
                                        </tr>  
                                    </thead>  
                                    <tbody>  ';
                                    while ($row = mysqli_fetch_array($result)) {
                                                    echo '<tr>';
                                                    echo '<td>' . $row['user_id'] .  '</td>';
                                                    echo '<td>' ;
                                                        switch ($row['apply_type']) {
                                                            case "1":
                                                                echo "借书";
                                                                break;
                                                            case "2":
                                                                echo "还书";
                                                                break;
                                                            case "3":
                                                                echo  "丢失损毁";  
                                                            }
                                                    echo '</td>';
                                                    echo '<td>' . $row['book_id'] . '</td>';
                                                    echo '<td>' . $row['ISBN'] . '</td>';
                                                    echo '<td>' . $row['approval_state'] . '</td>';
                                                    date_default_timezone_set("Asia/Shanghai");
                                                    echo '<td>' . date("Y/m/d h:ia",$row['apply_time']) . '</td>';
                                             
                                                      echo '<td>' . date("Y/m/d h:ia",$row['operate_time']) . '</td>';
                                                    echo '</tr>';

                                }}


                            ?>
                                    </tbody>  
                            </table>
                        </div>  
                    </div>
                </div>
    </div>
    
</body>
</html>