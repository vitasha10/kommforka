<?php
    $link = mysqli_connect('localhost','root','hack8908','mybd');
    $result = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `_server1_` WHERE `name`='commentname'"));
    echo $result['data'];
?>