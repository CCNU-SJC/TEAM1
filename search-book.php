<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="referrer" content="no-referrer"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>图书管理系统-查询图书</title>
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
<div class="bg">
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
                                <input class="btn btn-primary" type="submit" name="search" value="查找图书" onclick="SearchData()">  
                                <button class="btn btn-success" type="button"><a style='color:rgb(255, 255, 255)' href="user-approval.php">个人信息</a></button>  
                            </div>  
                        </div>  
                    </form>  
                </div>  
        </div> 
   </div>


<?php

error_reporting(0);
    
$name = $_POST['name'];
$author = $_POST['author'];
$ISBN = $_POST['ISBN'];

$dbc = mysqli_connect('localhost','root','','book_manager');
$query = "SELECT * FROM book_info WHERE name = '$name' OR author = '$author' OR ISBN = '$ISBN'";
$result = mysqli_query($dbc,$query) or die("error quering database". mysqli_error($dbc));

if(($_POST['search'])) 
{  
    if (mysqli_num_rows($result) )
    {     echo '<div class="container book">';
          echo 
          '<fieldset>
          <legend>查询结果</legend>
          </fieldset> '; 
          echo '<table class="table table-striped table-hover table-responsive">';
          echo '<thead> 
          <tr>
          <th>书名</th>
          <th>作者</th>
          <th>编号</th>
          <th>ISBN</th>
          <th>状态</th>
          </tr>  
          </thead>
          </tbody>
          ';
          while ($row = mysqli_fetch_array($result)) 
        {
        
          echo '<tr>';
          echo '<td>' . $row['name'] .  '</td>';
          echo '<td>' . $row['author'] .  '</td>';
          echo '<td>' . $row['book_id'] . '</td>';
          echo '<td>' . $row['ISBN'] . '</td>';
          echo '<td>' . $row['state'] . '</td>';
          echo '<td><div class="theme-buy">
                <a  class="btn btn-primary btn-large theme-login" data-ISBN="' .$row['ISBN']. '" href="javascript:;">详情</a>
                </div></td>';
           
            if($row['state']=='0')
            {
                echo '<td><div class="theme-buy">
                                
                <a class="btn btn-info" type="submit" value="申请借书" name="reserve" href="apply.php?book_id='.$row['book_id'].'">申请借书</a>
                
                </div></td>';
            }
            else
            {
                echo '<td><input class="btn btn-danger" type="button" value="不可借阅"></td>';
            }


          echo '</tr>';
          echo "</tbody>";
         


        }
        

        echo '</table>';
        echo '</div>';

    }  
    

    else
    {
        echo "<script>alert('无所查图书！');history.go(-1);</script>";  
    }
}


?>
</div>

<!--对如何在详情页中显示数据库数据存在疑问 -->

<div class="theme-popover" style="display: none;">
             <div class="theme-poptit">
                  <a href="javascript:;" title="关闭" class="close">×</a>
                  <h3>图书详情</h3>  
             </div>
             
            <div id="api_content6"></div>
            <div class="theme-popbod dform">
                <form class="theme-signin" name="loginform" action="" method="post">
                   <ul>

                      <li><strong>书名：</strong><small id="api_content1"></small></li>
                      <li><strong>作者:</strong><small id="api_content2"></small></li>
                      <li><strong>ISBN：</strong><small id="api_content3"></small></li>
                      <li><strong>出版社:</strong><small id="api_content4"></small></li>
                      <li><strong>图书简介:</strong><small><textarea id="api_content5"></textarea></small></li>

                   </ul>
                </form>
            </div> 

    </div>
         
    <div class="theme-popover-mask" style="display: none;"></div>

 <script>

            jQuery(document).ready(function($) {
                    $('.theme-login').click(function(){
                        $('.theme-popover-mask').fadeIn(100);
                        $('.theme-popover').slideDown(200);
                    });

                    $('.theme-login').one('click',function(){
                         var isbn=$(this).attr("data-isbn")
                         var url = "https://api.douban.com/v2/book/isbn/:" + isbn;
                    $.ajax({
                    url: url, 
                    dataType:'jsonp',
                    type:'get',
                     success:function(data){
                        $("#api_content1").append(data.title);
                        $("#api_content2").append(data.author[0]);
                        $("#api_content3").append(data.isbn13);
                        $("#api_content4").append(data.publisher);
                        $("#api_content5").append(data.summary);
                        $("#api_content6").append("<img src=" +data.image+">");
                    }
                  })
                });

                    $('.theme-poptit .close').click(function(){
                        $('.theme-popover-mask').fadeOut(100);
                        $('.theme-popover').slideUp(200);
                    })
            })

            
 </script>
 
</body>
</html>
