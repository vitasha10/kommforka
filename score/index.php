<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <title>Оценка</title>
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
        input{
            background-color:#FFD077;
            border-color:#1B7D21;
            color:#7120AB;
            border-radius:1vh;
            height:5vh;
            width:5vh;
            text-align:center;
            font-size:2vh;
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
            margin-top:1vh;
            height:auto;
            width:80vw;
            margin:0 auto;
            word-wrap: break-word;
        }
        .commandname{
            display:block;
            text-align:left;
            width:50vw;
            font-size:4vw;
            font-family: 'Lobster', cursive;
            color:#7120AB;
            margin-right:2vw;
        }
        .comment{
            text-align:left;
            font-size:2vw;
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
            width:5vw;
            text-align:center;
            font-size:1.3vw;
        }
        .namecomment{
            font-size:1vw;
            font-family: 'Lobster', cursive;
            text-align:left;
            color:#7120AB;
        }
        tr{
            display:block;
            width:80vw;
        }
    </style>
</head>
<body>
    <div class="commentsdiv"></div>
    <script>
    var oldcomments;
    function newscore(id){
        var score = document.getElementById("scoreinput"+id).value;
        $.ajax({
            type: "POST",
            url: "newscore.php",
            dataType: 'text',
            data: {id: id, score: score},
            success: function(data){
                alert("Успешно!");
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
                        $(".commentsdiv").append("<tr><td><ul><li class='commandname'>" + comments[i].command + "</li></td></tr><tr><td><li class='commentdate'>" + comments[i].date + "</li></ul></td><td><ul><li class='namecomment'>комментируют " + comments[i].name + "</li><li class='comment'>" + comments[i].comment + "</li></ul></td><td><input type='number' id='scoreinput"+comments[i].id+"' value='"+comments[i].score+"'><button onclick='newscore("+comments[i].id+")'>Обновить</button></td></tr>");
                    }
                }
            }
        })
    }
    comments();
    //setInterval(comments,30000);
    </script>
</body>
</html>