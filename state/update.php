<?php
  $book_id = $_GET['book_id'];

  $name = $_POST['name'];
  $author = $_POST['author'];
  $ISBN = $_POST['ISBN'];
        $dbc = mysqli_connect('localhost','root','','book_manager');
      $query ="UPDATE book_info SET name=$name, author=$author, ISBN=$ISBN, press=$press,introduction=$introduction WHERE book_id = $book_id";
      mysqli_query($dbc,$query) or die("error quering database". mysqli_error($dbc));
      mysqli_close($dbc);
      header('location:'.'change-book.php');
      exit;