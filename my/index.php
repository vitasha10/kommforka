<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Caveat|Neucha&display=swap" rel="stylesheet"> 
    <style>
        *{
            padding:0;
            margin:0;
            font-family: 'Noto Sans', sans-serif;
        }
        .logo{
            font-family: 'Neucha', cursive;
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
        h2{
            padding-top:1vh;
            font-size:7vw;
            font-family: 'Lobster', cursive;
            color:#7120AB;
        }
        h3{
            padding-top:1vh;
            font-size:3vw;
        }
        input{
            background-color:#FFD077;
            border-color:#1B7D21;
            color:#7120AB;
            border-radius:10vh;
            height:5vh;
            width:80vw;
            text-align:center;
            font-size:2vh;
            margin:0.5vh;
        }
        textarea{
            background-color:#FFD077;
            border-color:#1B7D21;
            color:#7120AB;
            border-radius:2vh;
            height:15vh;
            width:80vw;
            text-align:center;
            font-size:3vh;
            margin:0.5vh;
        }
        .commentsdiv{
            margin-top:2vh;
            height:auto;
            width:80vw;
            margin:0 auto;
            word-wrap: break-word;
        }
        .commandname{
            display:block;
            text-align:left;
            width:50vw;
            font-size:5vw;
            font-family: 'Lobster', cursive;
            color:#7120AB;
            margin-right:2vw;
        }
        .comment{
            text-align:left;
            font-size:4.6vw;
            font-family: 'Neucha', cursive;
            color:#7120AB;
            width:60vw;
        }
        ul{
            text-decoration:none;
            list-style:none;
        }
        .commentdate{
            display:block;
            font-family: 'Neucha', cursive;
            width:20vw;
            text-align:center;
            font-size:2.5vw;
        }
        .namecomment{
            font-size:3.3vw;
            font-family: 'Lobster', cursive;
            text-align:left;
            color:#7120AB;
        }
        tr{
            display:block;
            width:80vw;
        }
        .blockmc{
            float:left;
            width:100%;
            height:auto;
            font-size:2.5vh;
        }
        .color{
            border-radius:50%;
            display:block;
            margin:0 auto;
            height:7vh;
            width:7vh;
        }
        #mysum{
            font-size:10vh;
        }
    </style>
</head>
<body>
    <main>
        <h2>Загрузка...</h2>
    </main>
    <?php
        if(!isset($_COOKIE['command_id'])){
            echo '<h1>Не авторизован</h1>';
            echo '<meta http-equiv="refresh" content="0;URL=/">';
        }
    ?>
    <script>
    var oldstatus;
    var oldcomments;
    var intervalid;
    var commentname;
    var sum;
    var myname = "error";
    
    $.ajax({
        type: "POST",
        url: "name.php",
        dataType: 'text',
        data: {text: 'Текст'},
        success: function(data){
            myname = data;
        }
    })
    function procomments(){
        $.ajax({
            type: "POST",
            url: "commentname.php",
            dataType: 'text',
            data: {text: 'Текст'},
            success: function(data){
                if(commentname!=data){
                    commentname=data;
                    $('#whatcommenting').val(commentname);
                }        
            }
        })
        $.ajax({
            type: "POST",
            url: "procomments.php",
            dataType: 'text',
            data: {text: 'Текст'},
            success: function(data){
                var comments = JSON.parse(data);
                if(comments!=oldcomments){
                    oldcomments=comments;
                    $(".commentsdiv").empty();
                    $(".commentsdiv").append("<table id='msg-box' style='display: block; overflow: auto; max-width: 100wh; max-height:60vh;'></table>");
                    for(let i=0; i < comments.length; i ++){
                        $(".commentsdiv").append("<tr><td><ul><li class='commandname'>" + comments[i].command + "</li></td></tr><tr><td><li class='commentdate'>" + comments[i].date + "</li></ul></td><td><ul><li class='namecomment'>комментируют " + comments[i].name + "</li><li class='comment'>" + comments[i].comment + "</li></ul></td></tr>");
                    }
                }
            }
        })
    }
    function comments(){ 
        $.ajax({
            type: "POST",
            url: "comments.php",
            dataType: 'text',
            data: {text: 'Текст'},
            success: function(data){
                var comments = JSON.parse(data);
                if(comments!=oldcomments){
                    oldcomments=comments;
                    $(".commentsdiv").empty();
                    $(".commentsdiv").append("<table id='msg-box' style='display: block; overflow: auto; max-width: 100wh; max-height:60vh;'></table>");
                    for(let i=0; i < comments.length; i ++){
                        $(".commentsdiv").append("<tr><td><ul><li class='commandname'>" + comments[i].command + "</li></td></tr><tr><td><li class='commentdate'>" + comments[i].date + "</li></ul></td><td><ul><li class='namecomment'>комментируют " + comments[i].name + "</li><li class='comment'>" + comments[i].comment + "</li></ul></td></tr>");
                    }
                }
            }
        })
    }
    function sum(){
        $.ajax({
            type: "POST",
            url: "sum.php",
            dataType: 'text',
            data: {text: 'Текст'},
            success: function(data){
                if(sum!==data){
                    sum=data;
                    $("#mysum").empty();
                    $('#mysum').append(sum);
                }        
            }
        })
    }
    function update(){
        $.ajax({
            type: "POST",
            url: "update.php",
            dataType: 'text',
            data: {text: 'Текст'},
            success: function(data){
                var status = data;
                if(status!=oldstatus){
                    oldstatus=status;
                    clearInterval(intervalid);
                    if(status=="logo"){
                        $("main").empty();
                        $("main").append("<h1>Образовательное событие '<span class='logo'>Комм</span>форка'</h1><h2>Личный кабинет.</h2>");
                    }else if(status=="myname"){
                        $("main").empty();
                        $("main").append("<h2>" + myname + "</h2>");
                    }else if(status=="dinner"){
                        $("main").empty();
                        $("main").append("Обед");
                    }else if(status=="masterclasses"){
                        $("main").empty();
                        $("main").append("<div class='blockmc'><h3>«Не обожгись! Приемы безопасного комментирования»</h3><div class='color' style='background-color:red;'></div><p>Мастер-класс посвящен правовым и этическим аспектам комментирования в интернете.</p><p>Кабинет № 8. 2 этаж</p></div>");
                        $("main").append("<div class='blockmc'><h3>«И о чем это я…? Понимаю себя»</h3><div class='color' style='background-color:yellow;'></div><p>Мастер-класс направлен на освоение умения точно понять и выразить свое отношение к прочитанному/просмотренному тексту, т.е. к содержанию своего коммента.</p><p>Кабинет № 11. 2 этаж</p></div>");
                        $("main").append("<div class='blockmc'><h3>«Шаблон vs оригинальность»</h3><div class='color' style='background-color:white;'></div><p>Мастер-класс посвящен стилистическим особенностям  комментария.</p><p>Кабинет № 6. 1 этаж</p></div>");
                        //$("main").append("<div class='blockmc'><h3>«О чем ты, друг? Понимаю другого»</h3><div class='color' style='background-color:black;'></div><p>Мастер-класс посвящен обучению умению интерпретировать чужое высказывание, определению авторской позиции в нем, определению и формулированию собственной позиции.</p><p>Кабинет № . 2 этаж</p></div>");
                        $("main").append("<div class='blockmc'><h3>Безопасность в сети.</h3><div class='color' style='background-color:green;'></div><p>На мастер-классе с элементами ролевой игры участники узнают о безопасном, грамотном  (осознанном) потреблении информации из медиа и соцсетей, ее проверке, о критическом мышлении, защите от манипуляций, политической пропаганды и fake news, разовьют навыки жизни в эпоху информационной перегрузки.</p><p>Кабинет № 12. 2 этаж</p></div>");
                        $("main").append("<div class='blockmc'><h3>Конструктивная коммуникация.</h3><div class='color' style='background-color:blue;'></div><p>Участники мастер-класса узнают, как грамотно выстраивать деловую и публичную коммуникацию, как составлять письма сообщения незнакомым и знакомым людям для решения рабочих вопросов, как отвечать на вопросы, корректно отказывать и просить решить вопрос.</p><p>Кабинет № 7. 2 этаж</p></div>");
                    }else if(status=="studii"){
                        $("main").empty();
                        $("main").append("<div class='blockmc'><h3>Приемы безопасного комментиро-вания: практика.</h3><div class='color' style='background-color:red;'></div><p>Участники создадут и оценят на безопасность с точки зрения закона комментарии друг друга.</p><p>Кабинет № 8. 2 этаж</p></div>");
                        $("main").append("<div class='blockmc'><h3>Безопасность в сети: практика.</h3><div class='color' style='background-color:yellow;'></div><p>Участники потренируются в определении дезинформации в соцсетях и защите от неё.</p><p>Кабинет № 11. 2 этаж</p></div>");
                        $("main").append("<div class='blockmc'><h3>Комментарий к видео: практика.</h3><div class='color' style='background-color:white;'></div><p>Участники потренируются в определении некорректных комментариев и созданию собственного.</p><p>Кабинет № 6. 1 этаж</p></div>");
                        //$("main").append("<div class='blockmc'><h3>«О чем ты, друг? Понимаю другого»</h3><div class='color' style='background-color:black;'></div><p>Мастер-класс посвящен обучению умению интерпретировать чужое высказывание, определению авторской позиции в нем, определению и формулированию собственной позиции.</p><p>Кабинет № . 2 этаж</p></div>");
                        $("main").append("<div class='blockmc1'><h3>Комментарий к постам в социальной сети: практика.</h3><div class='color' style='background-color:green;'></div><p>Участники потренируются в определении некорректных комментариев и созданию собственного комментария.</p><p>Кабинет № 12. 2 этаж</p></div>");
                        $("main").append("<div class='blockmc1'><h3>Комментарий к новости: практика.</h3><div class='color' style='background-color:blue;'></div><p>Участники потренируются в определении некорректных комментариев и созданию собственного комментария.</p><p>Кабинет № 7. 2 этаж</p></div>");
                    }else if(status=="procomments"){
                        $("main").empty();
                        $("main").append("<h2>Битва комментаторов «Комментариум»</h2> <form action='pronewcomment.php' method='post'>"+
                            "<input id='whatcommenting' type='hidden' name='name' placeholder='Что комментируем:' required><br>"+
                            "<textarea name='comment' placeholder='Комментарий:' required autofocus></textarea><br>"+
                            "<input type='submit' name='procomments' value='Опубликовать!'>"+
                        "</form>"+
                        "<div class='commentsdiv'>"+
                        "</div>");
                        procomments();
                        intervalid=setInterval(procomments,3000);
                    }else if(status=="comments"){
                        $("main").empty();
                        $("main").append("<h2>Комментарии</h2> <form action='newcomment.php' method='post'>"+
                            "<input id='whatcommenting' type='text' name='name' placeholder='Что комментируем:' required><br>"+
                            "<textarea name='comment' placeholder='Комментарий:' required autofocus></textarea><br>"+
                            "<input type='submit' name='procomments' value='Опубликовать!'>"+
                        "</form>"+
                        "<div class='commentsdiv'>"+
                        "</div>");
                        comments();
                        intervalid=setInterval(comments,3000);
                    }else if(status=="endfirstday"){
                        $("main").empty();
                        $("main").append("<h1>Образовательное событие '<span class='logo'>Комм</span>форка'</h1><h2>Спасибо за участие в первом дне мероприятия!</h2>");
                    }else if(status=="end"){
                        $("main").empty();
                        $("main").append("<h1>Образовательное событие '<span class='logo'>Комм</span>форка'</h1><h2>Спасибо за участие в мероприятии!</h2>");
                    }else if(status=="sum"){
                        $("main").empty();
                        $("main").append("<h2>Мои баллы:</h2><div id='mysum'></div>");
                        sum();
                        intervalid=setInterval(sum,3000);
                    }else{
                        $("main").empty();
                        $("main").append("<h1>Образовательное событие '<span class='logo'>Комм</span>форка'</h1>");
                    }
                }
                
            }
        }); 
    }//<h3>Уважаемые участники Коммфорки! Желающих комплексно пообедать в столовой просим пройти к стойке регистрации на первом этаже, заплатить нужную сумму и получить талон на питение. На выходе из аудитории вас встретят волонтёры!</h3>
    update();
    $(document).ready(function(){
        setInterval(update,10000);
    }); 
    </script>
    
</body>
</html>