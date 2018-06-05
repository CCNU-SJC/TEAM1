<?php
  $id = $_GET['id'];

  $dbc = mysqli_connect('localhost','root','','book_manager');
  $query = "UPDATE apply SET approval_state=3 WHERE id=$id";
  $result = mysqli_query($dbc,$query) or die("error quering database". mysqli_error($dbc));
  header("Location:../change-manage.php");
  die();
 
