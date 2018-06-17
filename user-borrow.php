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

                            <li>
                                <a href="./user-approval.php" >
                                    <i class="glyphicon glyphicon-cog"></i>
                                    审批状态
                                    
                                </a>
                            </li>

                            <li class="change">
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
                            <div class="borrow">
                                    <fieldset>
                                            <legend>当前借阅</legend>
                                    </fieldset>
                                <table class="table table-striped table-hover table-responsive">  
                                        <thead>  
                                            <tr>
                                                <th>书名</th>
                                                <th>编号</th>
                                                <th>ISBN</th>
                                                <th>借阅时间</th>
                                            </tr>  
                                        </thead>  
                                        <tbody>  
                                        
                                        <?php

                                        $dbc = mysqli_connect('localhost','root','','book_manager');
                                        $query = "SELECT * FROM user_record WHERE return_time IS NULL";
                                        $result = mysqli_query($dbc,$query) or die("error quering database". mysqli_error($dbc));
                                        



                                        while ($row = mysqli_fetch_array($result)) 
                                        {

                                            echo '<tr>';
                                            echo '<td>' . $row['book_name'] .  '</td>';
                                            echo '<td>' . $row['book_id'] .  '</td>';
                                            echo '<td>' . $row['ISBN'] .  '</td>';
                                            echo '<td>' . $row['borrow_time'] .  '</td>';
                                            echo ' <td> <a class="btn btn-info" type="submit" value="申请还书" href="return.php?book_id='.$row['book_id'].'">申请还书</a>
                                                 <td> <a class=" btn btn-danger" type="submit" value="丢毁反馈" href="feedback.php?book_id='.$row['book_id'].'">丢毁反馈</a> 
                                                   
                                                </td>';
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
    </html>
