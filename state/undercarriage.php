<?php
  $id = $_GET['id'];

  $dbc = mysqli_connect('localhost','root','','book_manager');
  $query = "UPDATE apply SET approval_state='4' WHERE id=$id";
  $result = mysqli_query($dbc,$query) or die("error quering database". mysqli_error($dbc));
  header("Location:../change-book.php");
  die();
 
