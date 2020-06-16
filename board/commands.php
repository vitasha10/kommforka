<?php
    $link = mysqli_connect('localhost','root','hack8908','mybd');
    //DATE_FORMAT(`date`,'%d/%m/%Y<br> %H:%i') AS `date`
    //->fetch_all(MYSQLI_ASSOC)
    $sql = mysqli_query($link, "SELECT * FROM kommforka_commands ORDER BY id DESC");
    echo json_encode($sql->fetch_all(MYSQLI_ASSOC));
?>