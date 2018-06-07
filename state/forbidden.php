<?php
  $user_id = $_GET['user_id'];

  $dbc = mysqli_connect('localhost','root','','book_manager');
  $query = "UPDATE reader SET user_state='0' WHERE user_id=$user_id";
  $result = mysqli_query($dbc,$query) or die("error quering database". mysqli_error($dbc));
  header("Location:../change-person.php");
  die();
 
