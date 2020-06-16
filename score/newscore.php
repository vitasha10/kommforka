<?php
    $link = mysqli_connect('localhost','root','hack8908','mybd');
    if (isset($_POST["id"])) {
        $sql = mysqli_query($link, "UPDATE procomments SET `score` = '{$_POST['score']}' WHERE `id`='{$_POST['id']}'");
    }
?>