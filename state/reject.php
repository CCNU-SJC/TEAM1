<?php
  $id = $_GET['id'];
  date_default_timezone_set("Asia/Shanghai");
  $time = date("Y/m/d h:i:s");
  $approval_state = "不通过";
  $returned = "在架上";

  $dbc = mysqli_connect('localhost','root','','book_manager');
  $query = "UPDATE apply SET approval_state='$approval_state',operate_time='$time' WHERE id=$id";
  $result = mysqli_query($dbc,$query) or die("error quering database". mysqli_error($dbc));
  //调取apply信息
  $sql = "SELECT * FROM apply WHERE id = '$id'";
  $row = mysqli_fetch_array(mysqli_query($dbc,$sql));
  $apply_type = $row['apply_type'];
  $book_id = $row['book_id'];


  if($apply_type == "借书"){

  //更改图书信息
   $query3 = "UPDATE book_info SET state='$returned' WHERE book_id='$book_id' ";

  /// echo $query2;
  $result2 = mysqli_query($dbc,$query3) or die("error quering database". mysqli_error($dbc));}


  header("Location:../change-manage.php");
  die();
 