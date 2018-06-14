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

                            <li class="change">
                                <a href="./user-approval.php" >
                                    <i class="glyphicon glyphicon-cog"></i>
                                    审批状态
                                    <span id="num" class="label label-warning pull-right">5</span>
                                </a>
                            </li>

                            <li>
                                <a href="./user-borrow.php">
                                    <i class="glyphicon glyphicon-credit-card"></i>
                                    当前借阅        
                                </a>
                            </li>
        
                            <li>
                                <a href="./user-history.php">
                                    <i class="glyphicon glyphicon-globe"></i>
                                    借阅历史
                                </a>
                            </li>
        
                        </ul>
                    </div>

                    <div class="col-md-10">
                        <div class="approval">
                                <fieldset>
                                        <legend>审批状态</legend>
                                </fieldset>
                                <table id="test" class="table table-striped table-hover table-responsive">  
                                        <thead>  
                                            <tr>
                                                <th>图书名称</th>
                                                <th>图书编号</th>
                                                <th>ISBN</th>
                                                <th>申请状态</th>
                                                <th>申请时间</th>
                                            </tr>  
                                        </thead>  
                                        <tbody>
                                        


                                        <?php

                                        $dbc = mysqli_connect('localhost','root','','book_manager');
                                        $query = "SELECT * FROM apply";
                                        $result = mysqli_query($dbc,$query) or die("error quering database". mysqli_error($dbc));


                                        while ($row = mysqli_fetch_array($result)) 
                                        {
        
                                            echo '<tr>';
                                            echo '<td>' . $row['book_name'] .  '</td>';
                                            echo '<td>' . $row['book_id'] .  '</td>';
                                            echo '<td>' . $row['ISBN'] .  '</td>';
                                            echo '<td>' . $row['approval_state'] .  '</td>';
                                            echo '<td>' . $row['apply_time'] .  '</td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                       
                                        </tbody>  
                                </table>  
                        </div>
                    </div>
                </div>
                       
    </div>
    
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
</html>