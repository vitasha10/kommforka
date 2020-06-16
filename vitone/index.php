<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
</head>
<body>
<?php
$link = mysqli_connect('localhost', 'root', 'hack8908', 'mybd');
if (!$link) {
    echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
    exit;
}

if(isset($_POST['mobile'])){
    $sql = mysqli_query($link, "UPDATE `_server1_` SET `data` = '{$_POST['mobile']}' WHERE `name`='mobile'");

}
if(isset($_POST['board'])){
    $sql = mysqli_query($link, "UPDATE `_server1_` SET `data` = '{$_POST['board']}' WHERE `name`='board'");

}
if(isset($_POST['commentname'])){
    $sql = mysqli_query($link, "UPDATE `_server1_` SET `data` = '{$_POST['commentname']}' WHERE `name`='commentname'");

}
if(isset($_POST['pp'])){
    $sql = mysqli_query($link, "UPDATE `_server1_` SET `data` = '{$_POST['pp']}' WHERE `name`='pp'");

}
if(isset($_POST['komm'])){
    $sql = mysqli_query($link, "UPDATE `_server1_` SET `data` = '{$_POST['komm']}' WHERE `name`='commentname'");
    $sql = mysqli_query($link, "UPDATE `_server1_` SET `data` = '{$_POST['komm']}' WHERE `name`='pp'");
}
?>
<p>Телефоны</p>
<form action="" method="post">
    <input type="text" name="mobile" value="">
    <input type="submit" value="Обновить">
</form>
<p>Доска</p>
<form action="" method="post">
    <input type="text" name="board" value="">
    <input type="submit" value="Обновить">
</form>
<p>Что комментировать</p>
<form action="" method="post">
    <input type="text" name="commentname" value="">
    <input type="submit" value="Обновить">
</form>
<p>Слайд комментариума</p>
<form action="" method="post">
    <input type="text" name="pp" value="">
    <input type="submit" value="Обновить">
</form>
<p>Комментариум</p>
<form action="" method="post">
    <input type="text" name="komm" value="">
    <input type="submit" value="Обновить">
</form>
</body>
</html>