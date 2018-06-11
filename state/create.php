
<?php
error_reporting(0);
   //获取API
    $ISBN=$_GET['ISBN'];

    $url = "https://api.douban.com/v2/book/isbn/:" . $ISBN;
    $data = file_get_contents($url);
    $json_data = json_decode($data,true);

    $name = $json_data['title'];
    $author = $json_data['author'][0];
    $press  = $json_data['publisher'];
    $state  = "在架上";


    //连接数据库
    $dbc = mysqli_connect('localhost','root','','book_manager');

      $query ="INSERT INTO book_info(name,author,ISBN,press,state) 
               VALUES('$name','$author','$ISBN','$press','$state')";

      mysqli_query($dbc,$query) or die("error quering database". mysqli_error($dbc));
      mysqli_close($dbc);
      header('location:'.'../change-book.php');
      exit;

?>