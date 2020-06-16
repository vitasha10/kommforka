<?php
    $link = mysqli_connect('localhost','root','hack8908','mybd');
    //DATE_FORMAT(`date`,'%d/%m/%Y<br> %H:%i') AS `date`
    //->fetch_all(MYSQLI_ASSOC)
    $sql = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM kommforka_commands WHERE name='{$_COOKIE['command_name']}'"));
    echo $sql['score'];
?>