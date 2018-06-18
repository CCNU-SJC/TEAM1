<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>图书管理系统-确认还书申请</title>
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
    $user_id = $_GET['user_id'];

//get the infomation of the book
    $dbc = mysqli_connect('localhost','root','','book_manager');
    $query = "SELECT * FROM book_info WHERE book_id = $book_id";
    $result = mysqli_query($dbc,$query) or die("error quering database". mysqli_error($dbc));
    $row = mysqli_fetch_array($result);

    $name = $_POST['name'];
    $ISBN = $_POST['ISBN'];
    $apply_type = "还书";
    $approval_state = "待审批";
     date_default_timezone_set("Asia/Shanghai");
     $time = date("Y/m/d h:i:s");
     $state = "待还";

    if ($_POST){
      $query = "INSERT INTO apply(user_id,ISBN,name, book_id,apply_time,apply_type,approval_state) VALUES('$user_id','$ISBN','$name','$book_id','$time','$apply_type','$approval_state')";
      $query_tw0 = "UPDATE book_info SET state = '$state' WHERE book_id = '$book_id'";
      mysqli_query($dbc,$query) or die("error query database". mysqli_error($dbc));
      mysqli_query($dbc,$query_tw0) or die("error query database". mysqli_error($dbc));
      mysqli_close($dbc);
      header('location:'.'user-approval.php');
      exit;
    }
?>
   <div class="container body-content">
        <div class="panel panel-default">  
                <div class="panel-heading">确认还书申请</div>  
                <div class="panel-body">  
                    <form class="form-inline" method="post">  
                        <div class="row" >  
                            <div class=" col-md-4">  
                                <label class="control-label">图书名称：</label>  
                                <input type="text" class="form-control" name="name" value="<?php echo $row['name'] ?>" /> 
                            </div>
                            <div class=" col-md-4" >
                                <label class="control-label">图书编号：</label>  
                                <input type="text" class="form-control" name="book_id" value="<?php echo $row['book_id'] ?>" />  
                            </div> 
                                <div class=" col-md-4">  
                                    <label class="control-label"> ISBN：</label>  
                                    <input type="text" class="form-control" name="ISBN" value="<?php echo $row['ISBN'] ?>" /> 
                                </div>
                        </div>
          
                        <div class="row text-right" style="margin-top:20px;">  
                            <div class="col-sm-12">  
                                <button class="btn btn-primary" type=submit value="确认借阅" >确认归还</button>  
                                <button class="btn btn-success" type="button"><a style='color:rgb(255, 255, 255)' href="user-borrow.php">返 回</a></button>  
                            </div>  
                        </div>  
                    </form>  
                </div>  
        </div> 
   </div>
</body>
</html>
