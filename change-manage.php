<?php
//+php
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
    
<link rel="stylesheet" href="css/jPages.css">
<script src="js/jPages.min.js"></script>    

</head>

<body>
    <div class="navbar navbar-duomi navbar-static-top" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <div class="navbar-brand" id="logo">图书管理系统
                        </div>
                          <!--+html-->
                         <span class="glyphicon glyphicon-user"></span>&nbsp;你好，<?php echo $userRow['admin_name']; ?>&nbsp;
                       </a>
                       <a href="logout.php?logout=true">
                        <span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out
                      </a>
                    </div>
                </div>
    </div>
    
    <div style="min-height: 680px;" class="container-fluid">
                <div class="row">
                    <div id="nav-up" class="col-md-2">
                        <ul id="main-nav" class="nav nav-tabs nav-stacked" >
                            <li class="active">
                                <a href="#">
                                    <i class="glyphicon glyphicon-th-large"></i>
                                图书管理系统         
                                </a>
                            </li>

                            <li >
                                <a href="./change-book.php" >
                                    <i class="glyphicon glyphicon-cog"></i>
                                    书库管理
                                </a>
                            </li>

                            <li class="change">
                                <a href="./change-manage.php">
                                    <i class="glyphicon glyphicon-credit-card"></i>
                                    管理日志
                                    <span id="num" class="label label-warning pull-right" ></span>        
                                </a>
                            </li>
        
                            <li>
                                <a href="./change-person.php">
                                    <i class="glyphicon glyphicon-globe"></i>
                                    管理用户信息
                                </a>
                            </li>
        
                        </ul>
                    </div>
                    <div class="col-md-10">
                        <div class="approval">
                                <fieldset>
                                        <legend>审批状态</legend>
                                </fieldset>  
                                        
                                            <?php
                                               
                                               $dbc = mysqli_connect('localhost','root','','book_manager');
                                               $query = "SELECT * FROM apply WHERE approval_state='待审批' ORDER BY apply_time ASC";
                                               $result = mysqli_query($dbc,$query) or die("error quering database". mysqli_error($dbc));

                                               if (!mysqli_num_rows($result) ){
                                                    echo '<p>目前暂无申请……</p>';
                                                }

                                                else{
                                                     echo '<table class="table table-striped table-hover table-responsive" id="test">
                                                     <thead> 
                                                  <tr>
                                                    <th>用户账号</th>
                                                    <th>申请类型</th>
                                                    <th>图书ID</th>
                                                    <th>ISBN</th>
                                                    <th>申请时间</th>
                                                  </tr>  
                                                    </thead>
                                                    
                                                    <tbody id="apply_type">';
                                                    echo "<div class='holder'></div>";

                                                    
                                                    while ($row = mysqli_fetch_array($result)) {
                                                    echo '<tr>';
                                                    echo '<td>' . $row['user_id'] .  '</td>';
                                                    echo '<td>' . $row['apply_type'] .  '</td>';
                                                   //apply_type:借书、还书、丢失损毁
                                                    echo '<td>' . $row['book_id'] . '</td>';
                                                    echo '<td>' . $row['ISBN'] . '</td>';
                                                    echo '<td>' . $row['apply_time'] . '</td>';
                                                    echo '<td>' . $row['reason'] . '</td>';
                                                    echo '<td>';
                                                    if ($row['apply_type'] == "丢损"){
                                                       echo '<a class="btn btn-warning" href="state/undercarriage.php?id='.$row['id'].'">检查下架</a>';
                                                    } 
                                                    else{
                                                       echo '<a class="btn btn-primary" href="state/pass.php?id='.$row['id'].'">通过</a>
                                                            <a class="btn btn-danger" href="state/reject.php?id='.$row['id'].'">不通过</a>';
                                                    }
                                                    echo '</td>';
                                                    echo '</tr>';  
                                                }
                                                echo '</tbody>';
                                                echo '</table>';
                                            }
                                            ?> 
                                                
                                  
                        </div>
                        <div class="history">
                                <fieldset>
                                        <legend>操作历史</legend>
                                </fieldset>
                              
                            <?php
                               $handling = "待审批";
                               
                               $dbc = mysqli_connect('localhost','root','','book_manager');
                               $query = "SELECT * FROM apply WHERE approval_state!='$handling' ORDER BY apply_time ASC";
                               $result = mysqli_query($dbc,$query) or die("error quering database". mysqli_error($dbc));

                               if (!mysqli_num_rows($result) ){
                                    echo '<p>目前暂无操作历史……</p>';
                                }

                                else{
                                   echo '<table class="table table-striped table-hover table-responsive">
                                   <thead> 
                                        <tr>
                                            <th>用户账号</th>
                                            <th>申请类型</th>
                                            <th>图书ID</th>
                                            <th>ISBN</th>
                                            <th>操作类型</th>
                                             <th>申请时间</th>
                                            <th>操作时间</th>
                                        </tr>  
                                    </thead>  
                                   
                                    <tbody id="itemContainer">  ';
                                    echo "<div class='holder'></div>";

                                    while ($row = mysqli_fetch_array($result)) {
                                                    echo '<tr>';
                                                    echo '<td>' . $row['user_id'] .  '</td>';
                                                    echo '<td>' . $row['apply_type'] .  '</td>';
                                                   //apply_type:借书、还书、丢失损毁
                                                    echo '<td>' . $row['book_id'] . '</td>';
                                                    echo '<td>' . $row['ISBN'] . '</td>';
                                                    echo '<td class="approval_state">' . $row['approval_state'] .'</td>';
                                                    //approval_state:待审批、通过、不通过、检查下架
                                                    echo '<td>' . $row['apply_time'] .'</td>';
                                                    echo '<td>' .$row['operate_time'] . '</td>';
                                                    echo '</tr>';

                                }
                                echo ' </tbody>  ';
                                echo ' </table> ';
                              }
                            ?>
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
     function show(){
        var tab = document.getElementById("test");
        var rows = tab.rows.length-1;
        document.getElementById("num").innerHTML=rows;
        console.log(rows);
     }
    
    if ($("#test").length > 0){
       //当条件为 true 时执行的代码
       console.log(">0");
       show();
    }
     else{
       //当条件不为 true 时执行的代码
       console.log(">1");
       document.getElementById("num").style.display='none';
    }
</script>
    
<script>
$(document).ready(function () {
$("div.holder").jPages({
containerID: "apply_type","itemContainer",
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

 </html>
