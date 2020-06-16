<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Коммфорка</title>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Caveat|Neucha&display=swap" rel="stylesheet"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            padding-top:20vh;
        }
        h2{
            padding-top:1vh;
            font-size:4vw;
            font-family: 'Lobster', cursive;
            color:#7120AB;
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
            font-size:2.3vw;
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
            font-size:1.5vw;
            font-family: 'Lobster', cursive;
            text-align:left;
            color:#7120AB;
        }
        tr{
            display:block;
            width:80vw;
        }
        h3{
            padding-top:1vh;
            font-size:2vw;
            color:#1B7D21;
        }
        .link{
            font-size:5vw;
            color:#1B7D21;
            font-family: 'Noto Sans', sans-serif;
        }
        .blockmc{
            display:block;
            float:left;
            width:30vw;
            height:45vh;
            margin:1vh auto;
            font-size:2.5vh;
        }
        .blockmc1{
            float:left;
            width:45vw;
            height:45vh;
            margin:1vw;
            font-size:2.5vh;
        }
        .color{
            border-radius:50%;
            display:block;
            margin:0 auto;
            height:7vh;
            width:7vh;
        }
        video{
            height:99vh;
            width:98vw;
        }
        img{
            height:99vh;
            width:auto;
            max-width:99vw;
        }
        .happy{
            height:15vh;
            width:auto;
        }
        .prodiv{
            display:block;
            width:80vw;
            margin:0 auto;
        }
        .prodiv p{
            font-size:4vh;
        }
        </style>
</head>
<body>
    <main></main>
    <script>
    var pcstatus;
    var oldstatus;
    var oldcommands;
    var oldcomments;
    var intervalid;
    var sum;
    var commentname;
    function commands(){ 
        $.ajax({
            type: "POST",
            url: "commands.php",
            dataType: 'text',
            data: {text: 'Текст'},
            success: function(data){
                var commands = JSON.parse(data);
                if(JSON.stringify(commands) != JSON.stringify(oldcommands)){
                    oldcommands = commands;
                    $(".commandsdiv").empty();
                    //$(".commandsdiv").append("<table id='msg-box' style='display: block; overflow: auto; max-width: 100wh; max-height:60vh;'></table>");
                    for(let i=0; i < commands.length; i ++){
                        if(oldcommands[i].name != "admin"){
                            $(".commandsdiv").append("<h3 class='commandname1'>" + oldcommands[i].name + "</h3>");
                            //$(".commandsdiv").append("<h3 class='commandname1'>" + oldcommands[i].user1 + "</h3>");
                            //$(".commandsdiv").append("<h3 class='commandname1'>" + oldcommands[i].user2 + "</h3>");
                            //$(".commandsdiv").append("<h3 class='commandname1'>" + oldcommands[i].user3 + "</h3>");
                        }
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
                var sum1 = JSON.parse(data);
                if(JSON.stringify(sum1) != JSON.stringify(sum)){
                    sum = sum1;
                    $(".sumdiv").empty();
                    //$(".commandsdiv").append("<table id='msg-box' style='display: block; overflow: auto; max-width: 100wh; max-height:60vh;'></table>");
                    for(let i=0; i < sum.length; i ++){
                        if(sum[i].name != "admin"){
                            $(".sumdiv").append("<h3 class='commandname1'>" + sum[i].name + "</h3><p>" + sum[i].score + "</p>");
                            //$(".sumdiv").append("<h3 class='commandname1'>" + sum[i].score + "</h3>");
                        }
                    }
                }    
            }
        })
    }
    function procomments(){
        $.ajax({
            type: "POST",
            url: "procomments.php",
            dataType: 'text',
            data: {text: 'Текст'},
            success: function(data){
                if(pcstatus !== data){
                    pcstatus = data;
                    if(pcstatus=="1"){
                        $("main").empty();
                        $('main').append("<div class='prodiv'><h2>Пост в Фейсбуке</h2><p>По радио читали Гаспарова. Вышла из комнаты ровно на этом фрагменте:\"А вообще олимпийские судьи судили честно. Перед состязанием они должны были проверять лошадей, допускаемых к скачкам, и давали при этом две клятвы: во-первых, судить по совести и, во-вторых, никому не объяснять, почему они судили так, а не иначе. Греки понимали, что бывают и такие случаи, когда правильное решение чувствуешь, а объяснить не можешь\". Греки понимали. Правда, и статус олимпийского судьи высок. Однако понимали.</p><h3>Прим. фрагмент книги М.Гаспарова «Занимательная Греция».</h3></div>");
                    }
                    if(pcstatus=="2"){
                        $("main").empty();
                        $('main').append("<div class='prodiv'><h2>Фрагмент поста на «Меле»</h2><p>Давайте подумаем, как люди ходят в музеи? С умным видом праздно шатаются по залам, потребляя культуру примерно как еду с фуд-корта, разве что менее разборчиво? Этот стиль передаётся растерянным и неприкаянным детям, сопровождающим средне заинтересованных взрослых. Это в лучшем случае. В худшем всё затеяно ради селфи. Но на вопросы «Всё же зачем?» чаще всего слышится ответ «Привить культуру, а то сплошные смартфоны».</p></div>");

                    }
                    if(pcstatus=="3"){
                        $("main").empty();
                        $('main').append("<div class='prodiv'><h2>Исследование «Отказ от Facebook снижает уровень депрессии»</h2><p>Специалисты из эквадорского университета Лас-Америкас заявили, что отказ от использования социальной сети Facebook помогает людям в борьбе с депрессией. Об этом сообщил Daily Mail.Учёные предложили студентам Техасского университета поучаствовать в эксперименте. 1765 человек разделили на две группы. Первые прекращали пользование социальной сетью на неделю, вторые использовали её в обычном режиме.Исследователи пришли к выводу, что у первой группы улучшилась продуктивность и снизился уровень депрессии. Также учёные отметили, что те, кто отказался от социальной сети стали реже переедать и потреблять новости.</p></div>");
                    
                    }
                    if(pcstatus=="4"){
                        $("main").empty();
                        $('main').append("<div class='prodiv'><h2>Пост на «Меле»</h2><p style='font-size:3vh;'>На наших глазах происходит некоторые затирание нашей палитры живых реакций. Лингвист Максим Кронгауз в журнале Robb Report предсказывает, что введение новых эмотиконов, которые тестирует фейсбук (Love, Haha, Yay, Wow, Sad, Angry) приведет к ограничению социально приемлемых реакций в жизни. Раз мы больше времени общаемся в сети, логично экономить способы самовыражения. Уже сейчас иногда обидно, что вместо того, чтобы поставить смайлик, тебе приходится выслушивать человека и что-то еще ему отвечать.</p><img class='happy' src='https://kommforka.tk/files/happy.jpg'><p style='font-size:3vh;'>Нейробиологи тоже выражают  озабоченность. Японский профессор Рюта Кавашима обнаружил, что у подростков, которые играют в компьютерный игры, работает очень ограниченный кусок мозга, отвечающий за движения тела и зрение. Даже когда они перестают играть, лобные доли еще долгое время остаются «выключенными», а эти доли как раз отвечают за эмоции, умение держать под контролем спонтанные порывы, планирование. Авторы книги «Мозг Онлайн. Человек в эпоху интернета» Гэри Смолл и Гиги Ворган волнуются, что у поколения наших детей изменяется нейронный рисунок мозга вместе с угасанием социальных навыков.</p></div>");

                    }
                    if(pcstatus=="5"){
                        $("main").empty();
                        $('main').append("<div class='prodiv'><h2>Пост в Фейсбуке</h2><p>«Учиться - это и есть главная радость человеческой жизни. Даже - стержень ее. Переставший учиться словно уже умер, прервал путь. Учиться каждую минуту можно, в любом событии жизни - и для этого непременно нужно отношение, невозможно учиться \"самому по себе\". Так что все мы в мире друг другу учителя».</p></div>");
                    }
                    if(pcstatus=="6"){
                        $("main").empty();
                        $('main').append("<div class='prodiv'><h2>Новость из мира образования</h2><p>Школьники и студенты собрали фотографии преподавателей, которые с юмором подошли к своим занятиям. Так, один из преподавателей химии решил творчески подойти к разговорам школьников на уроке. Он начинал писать спойлеры к видеоиграм каждый раз, когда подростки начинали плохо себя вести.</p></div>");
                    }
                    if(pcstatus=="7"){
                        $("main").empty();
                        $('main').append("<div class='prodiv'><h2>Фрагмент поста из блога «Хорошо учиться — это как? И может ли троечник хорошо учиться?»</h2><p style='font-size:2.8vh;'>Когда мы слышим: «Я хорошо учился в школе», сразу представляем отличника, который к каждому уроку готов, всегда тянет руку и интересуется всем на свете. Неужели «хорошая учёба» — это так однобоко? Какие ещё «хорошие ученики» бывают? Наш блогер, учитель истории Анастасия Морозова рассуждает, какую учёбу можно назвать хорошей и зависят ли этого оценки в дневнике.</p><p style='font-size:2.8vh;'>Работая в школе с 2008 года, я точно могу сказать, что есть троечники, которые гораздо лучше учатся, чем некоторые хорошисты. Ведь главное не оценки, а знания и умения, которые получает ребёнок в школе.</p><p style='font-size:2.8vh;'>Кто-то постоянно читает, занимается в кружках, учит предметы, которые вызывают у него интерес, при этом абсолютно безответственно относится к определённой категории учебных занятий. Такой ребёнок может выучить наизусть стихотворение и прекрасно, выразительно его рассказать, а биологию, которую терпеть не может, не выучит или не сделает какие-то письменные задания.</p><p style='font-size:2.8vh;'>Конечно, не надо путать троечника, который чем-то интересуется, развивается и троечника, который ничего не хочет и ничего не делает. С хорошистами также. Поэтому, для школьников важно понимать, что учатся они не ради оценок, а ради навыков и умений, которые позволят в дальнейшем стать успешным человеком.</p></div>");
                    }
                    if(pcstatus=="8"){
                        $("main").empty();
                        $('main').append("<div class='prodiv'><h2>Пост на «Меле»</h2><p style='font-size:2.8vh;'>Подростки часто думают только о себе, они, кажется, не способны видеть мир и людей вокруг. Наш блогер, учитель русского языка и литературы, классный руководитель Александр Моисеев, рассуждает об эгоцентризме современных детей, его причинах и последствиях. В офтальмологии существует термин «туннельное зрение». Это «болезненное состояние зрения, при котором человек теряет способность к периферическому обзору…». Этот термин позаимствовали психологи и стали обозначать им болезненную сконцентрированность человека на какой-то одной проблеме.</p><p style='font-size:2.8vh;'>У сегодняшних детей (школьников, подростков, зачастую студентов) всё чаще обнаруживают такое «туннельное зрение». Он видит окружающую действительность как прямую линию, дорогу, на одном конце которой стоит он сам, а на другом — светлое будущее. В его восприятии на этой дороге нет больше никого: никто не перебегает её, не несётся навстречу с бешеной скоростью, не идёт на обгон на вираже, там нет ухабов и выбоин, льда и снега. Весь жизненный путь ребёнок воспринимает как свой личный. В представлении подростка весь мир — это всего лишь построенные кем-то удобные декорации, придуманные машины и механизмы для обеспечения спокойного пути. Причём этот кто-то, кто построил декорации, на дороге не появится...</p><p style='font-size:2.8vh;'>Следствия такого восприятия себя и окружающей действительности весьма плачевны. Завышенные ожидания ударяют по абсолютно неподготовленной личности с такой силой, с которой эти ожидания никогда не били по представителям старших поколений…</p></div>");
                    }
                    if(pcstatus=="9"){
                        $("main").empty();
                        $('main').append("<div class='prodiv'><h2>Фрагмент блога «Давайте все признаем, что Грета Тунберг чему-то нас научила»</h2><p style='font-size:3.3vh;'>Целый год шведская девочка Грета не ходила в школу по пятницам. Она училась и делала все задания в остальные дни. В пятницу она сидела перед парламентом и напоминала всем, что проблемы климата требуют срочного решения. Иначе будущее будет совсем другим. Не таким, к которому готовит современная школа. Мы просто не знаем всех проблем, которые наступят в результате глобального потепления. Как же школа это допустила? Я согласна с Людмилой Петрановской, что школа готовит детей к позавчерашнему миру. Образование всегда немного запаздывает, оно вообще довольно консервативный институт, но и оно может догонять. В прошлом году финские дети обсуждали проблемы пластика в океане, откуда он появился и что с ним делать. Этого нет по программе, просто сами учителя добавляют актуальные темы к фундаментальным знаниям. Именно в школе Грете Тунберг рассказали про глобальное потепление и проблемы экологии.</p></div>");
                    }
                    if(pcstatus=="10"){
                        $("main").empty();
                        $('main').append("<div class='prodiv'><h2>Новость</h2><p>Женщина раздала пассажирам рейса Сеул — Сан-Франциско беруши на случай, если её ребенок заплачет. Они не пригодились.</p><p>На рейсе Сеул — Сан-Франциско женщина раздала пассажирам больше 200 наборов, в каждом из которых находились беруши, корейские конфеты и записка с извинениями на случай, если в полете заплачет её четырехмесячный ребёнок.</p><p>Записка была написана от имени ребёнка: «Сегодня я собираюсь лететь в США вместе с мамой и бабулей, чтобы повидаться с тётей. Я могу немного нервничать и пугаться, потому что это мой первый в жизни перелёт, так что я могу расплакаться. Постараюсь лететь тихо, но не могу ничего обещать… Пожалуйста, простите». Во время перелёта ребёнок не заплакал.</p></div>");
                        //$('main').append("<div class='prodiv'><h2>Фрагмент поста блогера Даши Деденко</h2><p style='font-size:2.9vh;'>Некоторые российские вузы начисляют дополнительные баллы при поступлении за волонтёрскую работу, достаточно показать волонтёрскую книжку. В волонтёрство я пришла в прошлом году. Увидела позитивных и общительных ребят на одном из городских фестивалей и загорелась, очень захотелось быть с ними, так я попала в региональное отделение спортивных волонтёров в нашем городе. С тех пор стараюсь не пропускать мероприятия и помогать везде, где только можно. Для меня это возможность познакомиться с новыми людьми из моего города, побывать на разных мероприятиях и просто подарить улыбку незнакомому мне человеку! Но, на мой взгляд, в сфере добровольчества в ближайшем будущем будет не всё так гладко. Уже сейчас есть тенденция развития корыстного волонтёрства. За добровольную и неоплачиваемую работу часто дают бонусы: футболки, дипломы и грамоты, возможность поехать в заповедники и национальные парки. Некоторые люди охотно этим шансом пользуются, при этом не желая отдаться волонтёрству полностью, отработать и помочь. К тому же сейчас, чтобы поступить в вуз, у абитуриента обязательно должна быть активная гражданская позиция: ГТО, волонтёрство или олимпиады, а может, и всё вместе. Футболки, грамоты, дипломы, поездки в разные места — неплохой способ привлекать население. <…> Не погубит ли такая практика идею волонтёрского движения?</p></div>");
                    }
                    if(pcstatus=="11"){
                        $("main").empty();
                        $('main').append("<video src='https://kommforka.tk/files/proc1.mp4' alt='' controls autoplay>");
                    }
                    if(pcstatus=="12"){
                        $("main").empty();
                        $("main").append("<h2>Дождитесь подведения итогов!</h2>");
                    }
                    //$('main').append("<video src='https://kommforka.tk/files/красивое видео море чайки.mp4' alt='' controls autoplay>");
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
                        $("main").append("<h1>Образовательное событие '<span class='logo'>Комм</span>форка'</h1> <h2>kommforka.tk</h2>");
                    }else if(status=="dinner"){
                        $("main").empty();
                        $("main").append("Обед");
                    }else if(status=="procomments"){
                        $("main").empty();
                        procomments();
                        intervalid=setInterval(procomments,2000);
                    }else if(status=="comments"){
                        $("main").empty();
                        $("main").append("<h2>Комментарии</h2>" +
                        "<div class='commentsdiv'>"+
                        "</div>");
                        comments();
                        intervalid=setInterval(comments,3000);
                    }else if(status=="commands"){
                        $("main").empty();
                        $("main").append("<h2 class='link'>kommforka.tk</h2><h2>Команды:</h2>"+
                        "<div class='commandsdiv'>"+
                        "</div>");
                        commands();
                        intervalid=setInterval(commands,3000);
                    }else if(status=="sum"){
                        $("main").empty();
                        $("main").append("<h2>Счёт комманд:</h2>"+
                        "<div class='sumdiv'>"+
                        "</div>");
                        sum();
                        intervalid=setInterval(sum,3000);
                    }else if(status=="masterclasses"){
                        $("main").empty();
                        $("main").append("<div class='blockmc'><h3>«Не обожгись! Приемы безопасного комментирования»</h3><div class='color' style='background-color:red;'></div><p>Мастер-класс посвящен правовым и этическим аспектам комментирования в интернете.</p><p>Кабинет № 8. 2 этаж</p></div>");
                        $("main").append("<div class='blockmc'><h3>«И о чем это я…? Понимаю себя»</h3><div class='color' style='background-color:yellow;'></div><p>Мастер-класс направлен на освоение умения точно понять и выразить свое отношение к прочитанному/просмотренному тексту, т.е. к содержанию своего коммента.</p><p>Кабинет № 11. 2 этаж</p></div>");
                        $("main").append("<div class='blockmc'><h3>«Шаблон vs оригинальность»</h3><div class='color' style='background-color:white;'></div><p>Мастер-класс посвящен стилистическим особенностям  комментария.</p><p>Кабинет № 6. 1 этаж</p></div>");
                        //$("main").append("<div class='blockmc'><h3>«О чем ты, друг? Понимаю другого»</h3><div class='color' style='background-color:black;'></div><p>Мастер-класс посвящен обучению умению интерпретировать чужое высказывание, определению авторской позиции в нем, определению и формулированию собственной позиции.</p><p>Кабинет № . 2 этаж</p></div>");
                        $("main").append("<div class='blockmc1'><h3>Безопасность в сети.</h3><div class='color' style='background-color:green;'></div><p>На мастер-классе с элементами ролевой игры участники узнают о безопасном, грамотном  (осознанном) потреблении информации из медиа и соцсетей, ее проверке, о критическом мышлении, защите от манипуляций, политической пропаганды и fake news, разовьют навыки жизни в эпоху информационной перегрузки.</p><p>Кабинет № 12. 2 этаж</p></div>");
                        $("main").append("<div class='blockmc1'><h3>Конструктивная коммуникация.</h3><div class='color' style='background-color:blue;'></div><p>Участники мастер-класса узнают, как грамотно выстраивать деловую и публичную коммуникацию, как составлять письма сообщения незнакомым и знакомым людям для решения рабочих вопросов, как отвечать на вопросы, корректно отказывать и просить решить вопрос.</p><p>Кабинет № 7. 2 этаж</p></div>");
                    }else if(status=="studii"){
                        $("main").empty();
                        $("main").append("<div class='blockmc'><h3>Приемы безопасного комментиро-вания: практика.</h3><div class='color' style='background-color:red;'></div><p>Участники создадут и оценят на безопасность с точки зрения закона комментарии друг друга.</p><p>Кабинет № 8. 2 этаж</p></div>");
                        $("main").append("<div class='blockmc'><h3>Безопасность в сети: практика.</h3><div class='color' style='background-color:yellow;'></div><p>Участники потренируются в определении дезинформации в соцсетях и защите от неё.</p><p>Кабинет № 11. 2 этаж</p></div>");
                        $("main").append("<div class='blockmc'><h3>Комментарий к видео: практика.</h3><div class='color' style='background-color:white;'></div><p>Участники потренируются в определении некорректных комментариев и созданию собственного.</p><p>Кабинет № 6. 1 этаж</p></div>");
                        //$("main").append("<div class='blockmc'><h3>«О чем ты, друг? Понимаю другого»</h3><div class='color' style='background-color:black;'></div><p>Мастер-класс посвящен обучению умению интерпретировать чужое высказывание, определению авторской позиции в нем, определению и формулированию собственной позиции.</p><p>Кабинет № . 2 этаж</p></div>");
                        $("main").append("<div class='blockmc1'><h3>Комментарий к постам в социальной сети: практика.</h3><div class='color' style='background-color:green;'></div><p>Участники потренируются в определении некорректных комментариев и созданию собственного комментария.</p><p>Кабинет № 12. 2 этаж</p></div>");
                        $("main").append("<div class='blockmc1'><h3>Комментарий к новости: практика.</h3><div class='color' style='background-color:blue;'></div><p>Участники потренируются в определении некорректных комментариев и созданию собственного комментария.</p><p>Кабинет № 7. 2 этаж</p></div>");
                    }else if(status=="endfirstday"){
                        $("main").empty();
                        $("main").append("<h1>Образовательное событие '<span class='logo'>Комм</span>форка'</h1><h2>Спасибо за участие в первом дне мероприятия!</h2>");
                    }else if(status=="hoba"){
                        $("main").empty();
                        $("main").append("<h1>Хоба!!!</h1>");
                    }else{
                        $("main").empty();
                        $("main").append("<h1>Образовательное событие '<span class='logo'>Комм</span>форка'</h1><h2>kommforka.tk</h2>");
                    }
                }
                
            }
        }); 
    }
    update();
    $(document).ready(function(){
        setInterval(update,5000);
    }); 
    </script>
</body>
</html>