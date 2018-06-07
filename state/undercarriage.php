<?php
  $id = $_GET['id'];
  date_default_timezone_set("Asia/Shanghai");
  $time = date("Y/m/d h:i");
  $approval_state = "下架";

  $dbc = mysqli_connect('localhost','root','','book_manager');
  $query = "UPDATE apply SET approval_state='$approval_state',operate_time='$time' WHERE id=$id";
  $result = mysqli_query($dbc,$query) or die("error quering database". mysqli_error($dbc));
  header("Location:../change-manage.php");
  die();
 