<?php
date_default_timezone_set('Asia/Yekaterinburg');
$date=date("h:i:s");
$link = mysqli_connect('localhost','root','hack8908','mybd');
//mysql_query("SET NAMES 'utf8';");
//mysql_query("SET CHARACTER SET 'utf8';");
//mysql_query("SET SESSION collation_connection = 'utf8_general_ci';");
if(isset($_POST['procomments'])){  
    $sql = mysqli_query($link, "INSERT INTO `procomments` (`command`, `name`, `comment`, `date`) VALUES ('{$_COOKIE['command_name']}', '{$_POST['name']}', '{$_POST['comment']}', '{$date}')");
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
    <style>
        *{
            padding:0;
            margin:0;
            font-family: 'Noto Sans', sans-serif;
        }
        body{
            background: #FFFFC0;
            background: -webkit-linear-gradient(top left, #FFFFC0, #FFE673);
            background: -moz-linear-gradient(top left, #FFFFC0, #FFE673);
            background: linear-gradient(to bottom right, #FFFFC0, #FFE673);
            min-height:100vh;
            height:auto;
            width:100%;
            text-align:center;
            display:block;
            z-index:-1;
        }
        h1{
            font-size:10vw;
            font-family: 'Lobster', cursive;
            color:#7120AB;
            padding-top:30vh;
        }
    </style>
</head>
<body>
    <h1>Отправка сообщения!</h1>
    <meta http-equiv="refresh" content="0;URL=/my">
</body>
</html>