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

<?php
error_reporting(0);
    $book_id = $_GET['book_id'];

//get the infomation of the book
    $dbc = mysqli_connect('localhost','root','','book_manager');
    $query = "SELECT * FROM book_info WHERE book_id = $book_id";
    $result = mysqli_query($dbc,$query) or die("error quering database". mysqli_error($dbc));
    $row = mysqli_fetch_array($result);

    $name = $_POST['name'];
    $author = $_POST['author'];
    $ISBN = $_POST['ISBN'];
    $press = $_POST['press'];
    $introduction = $_POST['introduction'];

    if ($_POST){
      $query ="UPDATE book_info SET name='$name',author='$author',ISBN='$ISBN',press='$press',introduction='$introduction' WHERE book_id='$book_id'";
      mysqli_query($dbc,$query) or die("error quering database". mysqli_error($dbc));
      mysqli_close($dbc);
      header('location:'.'change-book.php');
      exit;
    }

?>
   <div class="container body-content">
        <div class="panel panel-default">  
                <div class="panel-heading">修改图书信息</div>  
                <div class="panel-body">  
                    <form class="form-inline" method="post">  
                        <div class="row" >  
                            <div class=" col-md-4">  
                                <label class="control-label">图书名称：</label>  
                                <input id="txtTitle" type="text" class="form-control" name="name" value="<?php echo $row['name'] ?>" /> 
                            </div>
                            <div class=" col-md-4" >
                                <label class="control-label">图书作者：</label>  
                                <input id="txtAuthor" type="text" class="form-control" name="author" value="<?php echo $row['author'] ?>" />  
                            </div> 
                            <div class=" col-md-4"> 
                                <label class="control-label">ISBN：</label>  
                                <input id="txtISBN" type="text" class="form-control" name="ISBN" value="<?php echo $row['ISBN'] ?>" />  
                            </div>  
                        </div>  
                        <div class="row" style="margin-top:20px;" >  
                                <div class=" col-md-4">  
                                    <label class="control-label"> 出 版 社 ：</label>  
                                    <input id="txtpublish" type="text" class="form-control" name="press" value="<?php echo $row['press'] ?>" /> 
                                </div>
                        </div>
                        <div class="row" style="margin-top:20px;" >  
                                <div class=" col-md-8">  
                                    <label class="control-label">图书简介：</label>  
                                    <textarea class="form-control" name="introduction" required="required" id="content" rows="4" value="<?php echo $row['introduction'] ?>" ></textarea>
                                </div>
                        </div> 
                         
          
                        <div class="row text-right" style="margin-top:20px;">  
                            <div class="col-sm-12">  
                                <button class="btn btn-primary" type=submit value="修改内容" ></button>  
                                <button class="btn btn-success" type="button"><a style='color:rgb(255, 255, 255)' href="./change-book.php">返 回</a></button>  
                            </div>  
                        </div>  
                    </form>  
                </div>  
        </div> 
   </div>


</body>
</html>
