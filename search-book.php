<?php
    error_reporting(0);
    
    $name = $_POST['name'];
    $author = $_POST['author'];
    $ISBN = $_POST['ISBN'];


    $dbc = mysqli_connect('localhost','root','','book_manager');

    mysqli_select_db("book_info",$dbc);
        
    mysqli_query($dbc,'set name utf8');
        
    $query = "SELECT * FROM book_info WHERE (name = $name) OR (author = $author) OR (ISBN = $ISBN)" ; 

    $result = mysqli_query($dbc,$query);

    $num = mysqli_num_rows($result);
            
    if($num)  
    {   echo "<table width='80%' border=1 align='center'>";
        echo "<th>书名</th>";
        echo "<th>作者</th>";
        echo "<th>ISBN</th>";
        echo "<th>出版社</th>";
        echo "<th>简介</th>";
        
        while($row=mysqli_fetch_array($result))
        {
            echo '<tr align="center">';
            echo '<td>' . $row['name'] .'</td>';
            echo '<td>' . $row['author'] .'</td>';
            echo '<td>' . $row['ISBN'] .'</td>';
            echo '<td>' . $row['press'].'</td>';
            echo '<td>' . $row['introduction'].'</td>';
            echo '</tr>';

        }
        echo "<table>";
    }  
        
    else  
    {  
        echo "<script>alert('不存在此书！');history.go(-1);</script>";  
    } 

?>