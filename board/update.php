<?php
    $link = mysqli_connect('localhost','root','hack8908','mybd'); // Соединяемся с базой
    $result = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `_server1_` WHERE `name`='board'"));
    echo $result['data'];
?>