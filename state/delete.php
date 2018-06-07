<?php
    $book_id=$_GET['book_id'];

    $dbc = mysqli_connect('localhost','root','','book_manager');
	$query = "DELETE FROM book_info WHERE book_id=$book_id";
	$result = mysqli_query($dbc,$query) or die("error quering database". mysqli_error($dbc));
	 header("Location:../change-book.php");
     die();
