<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>图书管理系统-书库管理</title>
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
                            <div class="container body-content" style="padding-top:20px;">  
                                    <div class="panel panel-default">  
                                        <div class="panel-heading">查询条件</div>  
                                        <div class="panel-body">  
                                            <form class="form-inline">  
                                                <div class="row">  
                                                    <div class="col-sm-4">  
                                                        <label class="control-label">图书名称：</label>  
                                                        <input id="txtTitle" type="text" class="form-control">  
                                                    </div>  
                                                    <div class="col-sm-4">  
                                                        <label class="control-label">图书作者：</label>  
                                                        <input id="txtAuthor" type="text" class="form-control">  
                                                    </div>  
                                                    <div class="col-sm-4">  
                                                        <label class="control-label">ISBN：</label>  
                                                        <input id="txtPublish" type="text" class="form-control">  
                                                    </div>  
                                                </div>  
                                  
                                                <div class="row text-right" style="margin-top:20px;">  
                                                    <div class="col-sm-12">  
                                                        <input class="btn btn-primary" type="button" value="查询" onclick="SearchData()">  
                                                        <button class="btn btn-success" type="button"><a style='color:rgb(255, 255, 255)' href="./create-book.php">创建新书</a></button>  
                                                    </div>  
                                                </div>  
                                            </form>  
                                        </div>  
                                    </div>  
                                  
                                <div class="book">
                                    <!--<table id="table"></table>--> 
                                    <fieldset>
                                            <legend>书库管理</legend>
                                    </fieldset>  
                                    <table class="table table-striped table-hover table-responsive">  
                                            <thead> 
                                             <?php
                                               
                                               $dbc = mysqli_connect('localhost','root','','book_manager');
                                               $query = "SELECT * FROM book_info ORDER BY book_id DESC";
                                               $result = mysqli_query($dbc,$query) or die("error quering database". mysqli_error($dbc));

                                               if (!mysqli_num_rows($result) ){
                                                    echo '<p>目前暂无书籍……</p>';
                                                    echo '</thead>';}                                               
                                                else{
                                                echo '<tr>
                                                    <th>图书id</th>
                                                    <th>书名</th>
                                                    <th>作者</th>
                                                    <th>ISBN</th>
                                                    <th>出版社</th>
                                                    <th>状态</th>
                                                    </tr>  
                                                    </thead>';  
                                                 while ($row = mysqli_fetch_array($result)) {
                                                    echo '<tbody>';
                                                    echo '<tr>';
                                                    echo '<td>' . $row['book_id'] .  '</td>'; 
                                                    echo '<td>' . $row['name'] .  '</td>';
                                                    echo '<td>' . $row['author'] .  '</td>';
                                                    echo '<td>' . $row['ISBN'] .  '</td>';      
                                                    echo '<td>' . $row['press'] .  '</td>'; 
                                                   echo '<td>' . $row['state'] .  '</td>';  
                                                    echo '<td><a class="btn btn-primary" href="edit-book.php?book_id='.$row['book_id'].'" >修改内容</a>
                                                        <a class="btn btn-info" href="state/delete.php?book_id='.$row['book_id'].'" >下架删除</a>
                                                        </td>';
                                                    echo '</tr>';   
                                                    echo ' </tbody> '; 
                                        }}
                                        ?> 
                                 
                                    </table>
                                </div>  
                            </div>  
                    </div>
                </div>
    </div>
    
</body>
</html>