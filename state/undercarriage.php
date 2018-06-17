<?php
  $id = $_GET['id'];
  date_default_timezone_set("Asia/Shanghai");
  $time = date("Y/m/d h:i:s");
  $approval_state = "下架";

  $dbc = mysqli_connect('localhost','root','','book_manager');
  $sql = "SELECT * FROM apply WHERE id = '$id'";
  $row = mysqli_fetch_array(mysqli_query($dbc,$sql));
  $book_id = $row['book_id'];

  $query = "UPDATE apply SET approval_state='$approval_state',operate_time='$time' WHERE id='$id'";
  $result = mysqli_query($dbc,$query) or die("error quering database". mysqli_error($dbc));

  $query2 = "UPDATE user_record SET return_time='$time' WHERE book_id='$book_id'";
  $result2 = mysqli_query($dbc,$query2) or die("error quering database". mysqli_error($dbc));

  header("Location:../change-book.php");
  die();
 