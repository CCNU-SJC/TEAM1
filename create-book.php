<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>图书管理系统-创建新书</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css"  href="css/create.css"/>
    <link rel="stylesheet" type="text/css"  href="css/bootstrap.css" />
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
   <div class="navbar navbar-duomi navbar-static-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="./index.html" id="logo">图书管理系统</a>
        </div>
   </div>
   <div class="container body-content">
        <div class="panel panel-default">  
                <div class="panel-heading">创建新书</div>  
                <div class="panel-body">  
                    <form class="form-inline" method="post">  
                        <div class="row" >  
                            <div class=" col-md-4">  
                                <label class="control-label">图书名称：</label>  
                                <input id="txtTitle" type="text" class="form-control" name="name" required="required"> 
                            </div>
                            <div class=" col-md-4" >
                                <label class="control-label">图书作者：</label>  
                                <input id="txtAuthor" type="text" class="form-control" name="author" required="required">  
                            </div> 
                            <div class=" col-md-4"> 
                                <label class="control-label">ISBN：</label>  
                                <input id="txtISBN" type="text" class="form-control" name="ISBN" required="required">  
                            </div>  
                        </div>  
                        <div class="row" style="margin-top:20px;" >  
                                <div class=" col-md-4">  
                                    <label class="control-label"> 出 版 社 ：</label>  
                                    <input id="txtpublish" type="text" class="form-control" name="press" required="required"> 
                                </div>
                        </div>
                        <div class="row" style="margin-top:20px;" >  
                                <div class=" col-md-8">  
                                    <label class="control-label">图书简介：</label>  
                                    <textarea class="form-control" name="introduction" required="required" id="content" rows="4"></textarea>
                                </div>
                        </div> 
                         
          
                        <div class="row text-right" style="margin-top:20px;">  
                            <div class="col-sm-12">  
                                <input class="btn btn-primary" type="submit" value="添加图书">  
                                <button class="btn btn-success" type="button"><a style='color:rgb(255, 255, 255)' href="./change-book.html">返 回</a></button>  
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
    $press = $_POST['press'];
    $introduction = $_POST['introduction'];
    $state = "在架上";

    $dbc = mysqli_connect('localhost','root','','book_manager');

    if ($_POST){
      $query ="INSERT INTO book_info(name,author,ISBN,press,introduction,state) VALUES('$name','$author','$ISBN','$press',
      '$introduction','$state')";
      mysqli_query($dbc,$query) or die("error quering database". mysqli_error($dbc));
      mysqli_close($dbc);
      header('location:'.'change-book.php');
      exit;
    }

?>

</body>
</html>