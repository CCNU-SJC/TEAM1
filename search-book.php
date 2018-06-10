<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>图书管理系统-创建新书</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css"  href="css/refer.css"/>
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
        <div class="navbar-header">
            <a class="navbar-brand" href="./index.html" id="logo">图书管理系统</a>
        </div>
   </div>
   <div class="container body-content">
        <div class="panel panel-default">  
                <div class="panel-heading">查找图书</div>  
                <div class="panel-body">  
                    <form class="form-inline" method="post">  
                        <div class="row" >  
                            <div class=" col-md-4">  
                                <label class="control-label">图书名称：</label>  
                                <input id="txtTitle" type="text" class="form-control" name="name"> 
                            </div>
                            <div class=" col-md-4" >
                                <label class="control-label">图书作者：</label>  
                                <input id="txtAuthor" type="text" class="form-control" name="author">  
                            </div> 
                            <div class=" col-md-4"> 
                                <label class="control-label">ISBN：</label>  
                                <input id="txtISBN" type="text" class="form-control" name="ISBN">  
                            </div>  
                        </div>  
                        
          
                        <div class="row text-right" style="margin-top:20px;">  
                            <div class="col-sm-7">  
                                <input class="btn btn-primary" type="submit" value="查找图书" onclick="SearchData()">  
                                <button class="btn btn-success" type="button"><a style='color:rgb(255, 255, 255)' href="./user-approval.html">个人信息</a></button>  
                            </div>  
                        </div>  
                    </form>  
                </div>  
        </div> 
   </div>

<?php

//还需解决详情显示、无结果提示问题
   
    error_reporting(0);
    
    $name = $_POST['name'];
    $author = $_POST['author'];
    $ISBN = $_POST['ISBN'];

    $dbc = mysqli_connect('localhost','root','','book_manager');
    $query = "SELECT * FROM book_info WHERE name = '$name' OR author = '$author' OR ISBN = '$ISBN'";
    $result = mysqli_query($dbc,$query) or die("error quering database". mysqli_error($dbc));
    $num = mysqli_num_rows($result);
            
    if (mysqli_num_rows($result) )
    {     echo '<div class="container body-content">';
          echo 
          '<fieldset>
          <legend>搜索结果</legend>
          </fieldset> '; 
          echo '<table class="table table-striped table-hover table-responsive">';
          echo '<thead> 
          <tr>
          <th>书名</th>
          <th>作者</th>
          <th>ISBN</th>
          </tr>  
          </thead>
          </tbody>
          ';
          while ($row = mysqli_fetch_array($result)) 
        {
        
          echo '<tr>';
          echo '<td>' . $row['name'] .  '</td>';
          echo '<td>' . $row['author'] .  '</td>';
          echo '<td>' . $row['ISBN'] . '</td>';
          echo '<td><div class="theme-buy">
                <a class="btn btn-primary btn-large theme-login" href="javascript:;">详情</a>
                </div></td>';
        echo '<td><div class="theme-buy">
                <a class="btn btn-primary btn-large theme-login">预约</a>
                </div></td>';
          echo '</tr>';
          echo "</tbody>";
        }
          echo '</table>';
          echo '</div>';
        }  


echo '<div class="theme-popover" style="display: none;">
             <div class="theme-poptit">
                  <a href="javascript:;" title="关闭" class="close">×</a>
                  <h3>图书详情</h3>
             </div>
             <div class="theme-popbod dform">
                   <form class="theme-signin" name="loginform" action="" method="post">
                        <ul>
                             <li><strong>书名：</strong></li>
                             <li><strong>作者：</strong></li>
                             <li><strong>ISBN：</strong></li>
                             <li><strong>出版社：</strong></li>
                             <li><strong>图书简介：</strong><small></small></li>
                        </ul>
                   </form>
             </div>
    </div>
    
    <div class="theme-popover-mask" style="display: none;"></div>';

       
?>

 <script>

                jQuery(document).ready(function($) {
                    $('.theme-login').click(function(){
                        $('.theme-popover-mask').fadeIn(100);
                        $('.theme-popover').slideDown(200);
                    })
                    $('.theme-poptit .close').click(function(){
                        $('.theme-popover-mask').fadeOut(100);
                        $('.theme-popover').slideUp(200);
                    })
                
                })
                
        </script>;

</body>
</html>
