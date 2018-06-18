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
    <title>图书管理系统-书库管理</title>
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
    
<link rel="stylesheet" href="css/jPages.css">
<script src="js/jPages.min.js"></script>

</head>

<body>
    <div class="navbar navbar-duomi navbar-static-top" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <div class="navbar-brand" href="/Admin/index.html" id="logo">图书管理系统</div>
                    </div>
                    <div class="nav-information">
                        <!--+信息--> 
                        <span class="glyphicon glyphicon-user"></span>&nbsp;你好，<?php echo $userRow['admin_name']; ?>&nbsp;</a>
                        <a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;退出</a>
                     </div>
                </div>
    </div>
    
    <div class="container-fluid" >
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
                                <a href="./change-book.php" style:"background-color: #3C4049;">
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
                                </a>
                            </li>
                            
        
                        </ul>
                    </div>
                    <div class="col-md-10">
                            <div class="container body-content" style="padding-top:20px;">  
                                    <div class="panel panel-default">  
                                        <div class="panel-heading">查询条件</div>  
                                        <div class="panel-body">  
                                            <form class="form-inline" method="post">  
                                                <div class="row">  
                                                    <div class="col-sm-4 row text-right">  
                                                      
                                                 <select style=height:32px; name = "select">
                                                  <option value="name">图书名称</option>
                                                  <option value="author">图书作者</option>
                                                  <option value="ISBN">ISBN</option>
                                                </select>
                                                    
                                                <input class="form-control" type="text" name="input" >    
                           
                                                   </div>  
                                  
                                                <div class="row text-right" style="margin-top:20px; margin-right:1em;">  
                                                    <div class="col-sm-12">  
                                                        <input class="btn btn-primary" type="submit" value="查询" onclick="SearchData()">  
                                                        <button class="btn btn-success" type="button"><a style='color:rgb(255, 255, 255)' href="./create-book.php">创建新书</a></button>  
                                                    </div>  
                                                </div>  
                                            </form>  
                                        </div>  
                                    </div>
                            </div>

                <div class="book">                                                                       
                    <fieldset>
                            <legend>书库管理</legend>
                    </fieldset>  
                    <table class="table table-striped table-hover table-responsive">  
                        <thead> 
                        <tr>
                        <th>编号</th>
                        <th>书名</th>
                        <th>作者</th>
                        <th>ISBN</th>
                        <th>出版社</th>
                        <th>状态</th>
                        </tr>  
                        </thead>
                        
                        <tbody  id="itemContainer">

                                
                                               
<?php

error_reporting(0);
    
$select = $_POST['select'];    
$input = $_POST['input'];


if ($_POST['input']){
    
    $dbc = mysqli_connect('localhost','root','','book_manager');
    //图书名称、作者模糊查询功能
    if($select == "ISBN" ){
       $query = "SELECT * FROM book_info WHERE ISBN = '$input'";
    }
  else{
    $query = "SELECT * FROM book_info WHERE $select LIKE '%$input%' ";
  }
  //echo $query;
  $result = mysqli_query($dbc,$query) or die("error quering database". mysqli_error($dbc));
}

//获取所有书籍
else{

  $dbc = mysqli_connect('localhost','root','','book_manager');
  $query = "SELECT * FROM book_info";
  $result = mysqli_query($dbc,$query) or die("error quering database". mysqli_error($dbc));
  
  echo"<div class='holder'></div>";


}


    if (mysqli_num_rows($result))
    {   
          while ($row = mysqli_fetch_array($result)) 
        {
        
          echo '<tr>';
          echo '<td>' . $row['book_id'] .  '</td>';
          echo '<td>' . $row['name'] .  '</td>';
          echo '<td>' . $row['author'] . '</td>';
          echo '<td>' . $row['ISBN'] . '</td>';
          echo '<td>' . $row['press'] . '</td>';
          echo '<td>' . $row['state'] . '</td>';
          echo '<td><div class="theme-buy">
             <a  class="btn btn-primary btn-large theme-login" data-ISBN="' .$row['ISBN']. '" href="javascript:;">详情</a>
                </div></td>';
          echo '<td>
                    <a class="btn btn-info" href="state/delete.php?book_id='.$row['book_id'].'" onclick="javascript:return del();" >下架删除</a>
                </td>';

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



?>
</div>


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

    


</body>
    

 <script>

            jQuery(document).ready(function($) {
                    $('.theme-login').click(function(){
                        $('.theme-popover-mask').fadeIn(100);
                        $('.theme-popover').slideDown(200);
                  
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
                        $("#api_content1").empty();
                        $("#api_content2").empty();
                        $("#api_content3").empty();
                        $("#api_content4").empty();
                        $("#api_content5").empty();
                        $("#api_content6").empty();
                    })
            })

            
 </script>




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
 </script>


 
 <script>
    function apply()
    {
        alert('已成功提交申请，等待管理员审核！')
        window.location.href = 'user-approval.php';
    }
</script>




<script>
    function del() {
        var msg = "您真的确定要删除吗？\n\n请确认！";
        if(confirm(msg)==true){
            return true;
        }
        else{
            return false;
        }
    }
</script>

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

</html>
