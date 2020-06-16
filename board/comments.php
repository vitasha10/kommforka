<?php
    $link = mysqli_connect('localhost','root','hack8908','mybd');
    //DATE_FORMAT(`date`,'%d/%m/%Y<br> %H:%i') AS `date`
    //->fetch_all(MYSQLI_ASSOC)
    $sql = mysqli_query($link, "SELECT id, command, comment, name, DATE_FORMAT(`date`,'%d/%m<br>%H:%i:%s') AS date FROM comments ORDER BY id DESC");
    echo json_encode($sql->fetch_all(MYSQLI_ASSOC));
?>