<?php
$link = mysqli_connect('localhost','root','hack8908','mybd'); // Соединяемся с базой
// Ругаемся, если соединение установить не удалось
if (!$link) {
    echo 'Не могу соединиться с БД. Код ошибки: '.mysqli_connect_errno().', ошибка: '.mysqli_connect_error();
    exit;
}
if(isset($_POST['login'])){
    $result1 = mysqli_fetch_array(mysqli_query($link, "SELECT `id`, `name` FROM `kommforka_commands` WHERE `kommforka_commands`.`name`='{$_POST['commandname']}'"));
    $result2 = mysqli_fetch_array(mysqli_query($link, "SELECT `pass` FROM `kommforka_commands` WHERE `kommforka_commands`.`name`='{$_POST['commandname']}'"));

    if ($_POST["pass"]==$result2['pass']){
        setcookie('command_id', $result1['id'], time()+259200, '/');
        setcookie('command_name', $result1['name'], time()+259200, '/');
        echo "<meta http-equiv='refresh' content='0;URL=/my'>";
    }else{
        echo "<script>alert('Неправильный пароль!');</script>";
    }
}
if(isset($_POST['newcommand'])){
    $sql = mysqli_query($link, "INSERT INTO `kommforka_commands` (`name`, `school`, `user1`, `user2`, `user3`, `pass`) VALUES ('{$_POST['commandname']}', '{$_POST['school']}', '{$_POST['user1']}', '{$_POST['user2']}', '{$_POST['user3']}', '{$_POST['pass']}')");
    echo "<meta http-equiv='refresh' content='0;URL=/my'>";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Коммфорка</title>
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
        header{
            background: #FFFFC0;
            background: -webkit-linear-gradient(top left, #FFFFC0, #FFE673);
            background: -moz-linear-gradient(top left, #FFFFC0, #FFE673);
            background: linear-gradient(to bottom right, #FFFFC0, #FFE673);
            height:100vh;
            width:100%;
            text-align:center;
            display:block;
            z-index:-1;
        }
        nav{
            position:fixed;
            top:0;
            height:10vh;
            width:100%;
        }
        nav div{
            width:65vw;
            margin:0 auto;
        }
        nav ul li{
            display:block;
            float:left;
            text-decoration:none;
        }
        header nav ul li a:hover{
            background-color:#7120AB;
            transition:0.3s;
            color:#FFBD22;
            /*
            border-top:0;
            border-right:0;
            border-left:0;
            border-bottom:10px;
            border-style:solid;
            border-color:#FF2822;
            */
        }
        nav a{
            color:#7120AB;
            display:block;
            height:10vh;
            width:13vw;
            padding:0 auto;
            text-transform:uppercase;
            text-decoration:none;
            line-height:10vh;
            transition:0.2s;
            font-size:1.3vw;
        }
        h1{
            font-size:15vh;
            font-family: 'Lobster', cursive;
            color:#7120AB;
            padding-top:30vh;
        }
        .logo{
            font-family: 'Neucha', cursive;
        }
        main{
            height:auto;
            display:block;
            width:100%;
        }
        .div1, .div3{
            background: #FFD077;
            background: -webkit-linear-gradient(top left, #FFD077, #FFCE80);
            background: -moz-linear-gradient(top left, #FFD077, #FFCE80);
            background: linear-gradient(to bottom right, #FFD077, #FFCE80);
            height:auto;
            display:block;
            width:100%;
        }
        .div2, .div4{
            background: #FFFFC0;
            background: -webkit-linear-gradient(top left, #FFFFC0, #FFE673);
            background: -moz-linear-gradient(top left, #FFFFC0, #FFE673);
            background: linear-gradient(to bottom right, #FFFFC0, #FFE673);
        }
        .about{
            display:block;
            height:auto;
            width:80vw;
            margin:0 auto;
            color:#7120AB;
            font-size:4vh;
            padding:10vh 0 10vh 0;
        }
        .about h2{
            font-size:9vh;
            margin:0 0 0 3vh;
            font-family: 'Lobster', cursive;
        }
        .timetable{
            display:block;
            height:auto;
            width:80vw;
            margin:0 auto;
            color:#7120AB;
            font-size:4vh;
            padding:10vh 0 10vh 0;
        }
        .timetable h2{
            font-size:9vh;
            margin:0 0 0 3vh;
            font-family: 'Lobster', cursive;
        }
        .login{
            display:block;
            height:100vh;
            width:80vw;
            margin:0 auto;
            color:#7120AB;
            font-size:4vh;
            padding-top:10vh;
        }
        .login h2{
            font-size:9vh;
            margin:0 0 0 3vh;
            font-family: 'Lobster', cursive;
        }
        .registr{
            display:block;
            height:100vh;
            width:80vw;
            margin:0 auto;
            color:#7120AB;
            font-size:4vh;
            padding-top:10vh;
        }
        .registr h2{
            font-size:9vh;
            margin:0 0 0 3vh;
            font-family: 'Lobster', cursive;
        }
        input{
            background-color:#FFFFC0;
            border-color:#1B7D21;
            color:#7120AB;
            border-radius:10vh;
            height:7vh;
            width:20vw;
            text-align:center;
            font-size:3vh;
        }
        .div2 input, .div4 input{
            background-color:#FFD077;
        }
        p{
            color:#1B7D21;
        }
        h3{
            color:#1B7D21;
        }
        footer{
            width:100%;
            padding:5vh 0 5vh 0;
            text-align:center;
            color:white;
            background-color:black;
            font-size:3vh;
        }
        .radio{
            height:10px;
            width:10px;
        }
        li{
            color:#1B7D21;
        }
        @media screen and (min-width: 200px) and (max-width: 1024px){
            nav{
                height:15vh;
            }
            nav div{
                width:100%;
                margin:0 auto;
            }
            nav ul li{
                display:block;
                float:left;
                text-decoration:none;
            }
            header nav ul li a:hover{
                background-color:#7120AB;
                transition:0.3s;
                color:#FFBD22;
                /*
                border-top:0;
                border-right:0;
                border-left:0;
                border-bottom:10px;
                border-style:solid;
                border-color:#FF2822;
                */
            }
            nav a{
                color:#7120AB;
                display:block;
                height:10vh;
                width:20vw;
                padding:0 auto;
                text-transform:uppercase;
                text-decoration:none;
                line-height:10vh;
                transition:0.2s;
                font-size:2.5vw;
            }
            h1{
                font-size:10vw;
                font-family: 'Lobster', cursive;
                color:#7120AB;
                padding-top:30vh;
            }
            .logo{
                font-family: 'Neucha', cursive;
            }
            main{
                /*
                background: #FFBD22;
                background: -webkit-linear-gradient(top left, #FFBD22, #FF2822);
                background: -moz-linear-gradient(top left, #FFBD22, #FF2822);
                background: linear-gradient(to bottom right, #FFBD22, #FF2822);
                */
                background: #FFFFC0;
                background: -webkit-linear-gradient(top left, #FFFFC0, #FFE673);
                background: -moz-linear-gradient(top left, #FFFFC0, #FFE673);
                background: linear-gradient(to bottom right, #FFFFC0, #FFE673);
                height:auto;
                display:block;
                width:100%;
                padding-bottom:5vh;
            }
            .about{
                display:block;
                height:auto;
                width:80vw;
                margin:0 auto;
                color:#7120AB;
                font-size:2vh;
                padding-top:10vh;
            }
            .about h2{
                font-size:4vh;
                margin:0 0 0 3vh;
                font-family: 'Lobster', cursive;
            }
            .timetable{
                display:block;
                height:auto;
                width:80vw;
                margin:0 auto;
                color:#7120AB;
                font-size:2vh;
                padding-top:10vh;
            }
            .timetable h2{
                font-size:4vh;
                margin:0 0 0 3vh;
                font-family: 'Lobster', cursive;
            }
            .login{
                display:block;
                height:100vh;
                width:80vw;
                margin:0 auto;
                color:#7120AB;
                font-size:2vh;
                padding-top:10vh;
            }
            .login h2{
                font-size:4vh;
                margin:0 0 0 3vh;
                font-family: 'Lobster', cursive;
            }
            .registr{
                display:block;
                height:auto;
                width:80vw;
                margin:0 auto;
                color:#7120AB;
                font-size:2vh;
                padding-top:10vh;
            }
            .registr h2{
                font-size:4vh;
                padding:0 0 0 3vh;
                font-family: 'Lobster', cursive;
            }
            input{
                /*background-color:#ff6b22;*/
                border-color:#1B7D21;
                color:#7120AB;
                border-radius:10vh;
                height:7vh;
                width:80vw;
                text-align:center;
                font-size:3vh;
            }
            p{
                color:#1B7D21;
            }
            h3{
                color:#1B7D21;
            }
            footer{
                width:100%;
                padding:5vh 0 5vh 0;
                text-align:center;
                color:white;
                background-color:black;
                font-size:3vh;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div>
                <ul>
                    <li><a href="/" class="nav-a">Главная</a></li>
                    <li><a href="#about" class="nav-a">О Коммфорке</a></li>
                    <li><a href="#timetable" class="nav-a">Расписание</a></li>
                    <li><a href="#login" class="nav-a">Логин</a></li>
                    <li><a href="#registr" class="nav-a">Регистрация</a></li>
                </ul>
            </div>
        </nav>
        <img src="" alt="">
        <h1>Образовательное событие "<span class="logo">Комм</span>форка"</h1>
    </header>
    <main>
        <div class="div1">
            <div id="about" class="about">
                <h2>О коммфорке:</h2>
                <p>   Образовательное событие «Коммфорка»– это возможность узнать от профессионалов, как грамотно выстраивать коммуникацию в цифровой среде, освоить речевые способы выражения своей точки зрения  и аргументировать ее с опорой на текст (визуальный или вербальный) в формате  комментария. В практике освоения умения комментировать формируется компетентность взаимодействия с другими: способность аргументировать свою позицию и принимать чужую.
<br>   «Коммфорка»  - формат  интерактивного образовательного погружения с фокусом на развитие навыков XXI века,   который мы разработали для тех старшеклассников, кто  хочет узнать, как грамотно выстраивать коммуникацию для жизни и учебы, как предотвращать и справляться с трудными ситуациями в онлайн-общении.
<br>   Участники образовательного события научатся грамотному и осознанному потреблению информации из медиа, разовьют навыки жизни в информационно насыщенной  среде, потренируют критическое и аналитическое мышление.
<br>   «Коммфорка»  - это два дня практических занятий, направленных на развитие способности адекватно ориентироваться в медиапространстве, соблюдать цифровую гигиену и продуктивно строить онлайн-коммуникацию.</p>
            </div>
        </div>
        <div class="div2">
            <div id="timetable" class="timetable">
                <h2>Расписание:</h2>
                <p>11 октября, пятница.</p>
                <p>Начало мероприятия в 10.00, окончание 13.30-14.00.</p>
                <ol>
                    <li>С 9:30 до 10:00 пройди регистрацию в рекреации на первом этаже, познакомься с программой мероприятия.</li>
                    <li>Стань участником церемонии открытия образовательного события «Коммфорка». Место проведения - актовый зал на 1 этаже. Определись со смыслами своего участия в мероприятии.10:00-10:20</li>
                    <li>Объединись с ребятами из твоей школы в группы по 3 человека. Зарегистрируйся на сайте kommforka.tk: для этого обсуди название команды, укажи свою школу, перечисли участников команды, и придумай пароль. Для дальнейшего входа в личный кабинет перейди в раздел логин на этой же страничке, укажи название команды, пароль и нажми на кнопку «Войти!».</li>
                    <li>С 10:30 до 11:30 проведение 1-й линейки мастер-классов. Посмотри в личном кабинете на сайте «Коммфорки» информацию про свой мастер-класс и проследуй в нужный кабинет. (Найди цвет кружка на сайте рядом с мастер-классом, который совпадает с цветом кружка, выданного вашей команде волонтерами).</li>
                    <li>С 11:30 до 12:00 электронная рефлексия участников мастер-классов. Обсуди результаты участия в первом мастер-классе с членами своей группы и оставь комменты на сайте «Коммфорка». Пообедай в столовой на 1 этаже.</li>
                    <li>С 12:00 до 13:00 проведение 2-й линейки мастер-классов. Посмотри в личном кабинете на сайте «Коммфорка» информацию про свой мастер-класс и проследуй в нужный кабинет. (Найди цвет кружка на сайте рядом с мастер-классом, который совпадает с цветом кружка, выданного вашей команде волонтерами).</li>
                    <li>Электронная рефлексия участников. Обсуди результаты участия во втором мастер-классе с членами своей группы и оставь комменты на сайте «Коммфорки».</li>
                    <li>С 14:00 завершение первого дня. Подведение итогов в актовом зале. Оставь свои комменты по поводу организации и содержания первого дня образовательного события.</li>
                </ol>
                
                <!--
                <ol>
                    <li>Регистрация участников (рекреация на  первом этаже) с 9.30 до 10.00.</li>
                    <li>Церемония открытия образовательного события «Коммфорка» (1 этаж, актовый зал) с 10.00. 
                        <ul>
                            <li>Выступление учащихся гимназии.</li>
                            <li>Приветственное слово Груздевой И.В., к.пед.н., директора МАОУ Гимназия № 10».</li>
                            <li>Приветственное слово Печищева И.М, научного руководителя проекта,  к.фил.н., доцента кафедры журналистики и массовых коммуникаций ПГНИУ.</li>
                            <li>Представление ведущих мастер-классов-преподавателей вузов г.Перми.</li>
                        </ul>
                    </li>
                    <li>Электронная регистрация групп-участников на участие в мастер-классах.</li>
                    <li>Проведение 1-й линейки мастер-классов (кабинеты на 2 этаже). Продолжительность мастер-класса – 60 мин. Каждый участник мероприятия сможет посетить 2 мастер-класса.</li>
                    <li>Рефлексия участников мастер-классов в формате комментария.</li>
                    <li>Обед (столовая, 1 этаж). (Прим.Питание участников осуществляется за счет участников или направляющей стороны).</li>
                    <li>Проведение 2-й линейки мастер-классов. Продолжительность мастер-класса – 60 мин.</li>
                    <li>Рефлексия участников мастер-классов в формате комментария.</li>
                    <li>Подведение итогов первого дня (актовый	 зал, 1 этаж).</li>
                </ol>
                <br>
                <br>
                <p>12 октября, суббота.</p>
                <p>Начало мероприятия в 10.00. окончание 13.30-14.00.</p>
                <ol>
                    <li>Регистрация участников (рекреация на  первом этаже) с 9.30 до 9.55.</li>
                    <li>Открытие второго дня. Представление ведущих студий - преподавателей  и магистрантов филологического факультета ПГНИУ. Актовый зал. 1 этаж</li>
                    <p>Продолжительность студии – 40 мин. Каждый участник мероприятия сможет посетить 2 студии.</p>
                    <li>Первая линейка студий (кабинеты на 2 этаже).</li>
                    <li>Рефлексия участников студий.</li>
                    <li>Вторая линейка студий (кабинеты на 2 этаже).</li>
                    <li>Рефлексия участников студий.</li>
                    <li>Обед (столовая, 1 этаж).</li>
                    <li>Конкурсное испытание для команд «Битва  комментаторов «Комментариум» (актовый зал, 1 этаж).</li>
                    <p>Комментарии, создаваемые  участниками во время конкурсного испытания,  оценивает компетентное жюри, в состав которого входят представители ПГНИУ. При оценке комментариев жюри руководствуется собственным профессиональным опытом, основываясь на критериях оценки. 
Победители контрольного испытания награждаются дипломами. Участники получают сертификаты. 
Педагоги получают сертификаты участников образовательного события.
Прим. После проведения образовательного события педагоги получат техническое задание на разработку 1-2-х учебных ситуаций по развитию умений комментировать в образовательном процессе (за эту работу тоже полагается сертификат).</p>
                    <li>Работа жюри по подведению итогов конкурсного испытания.</li>
                    <li>Закрытие образовательного события «Коммфорка». Награждение победителей.</li>
                </ol>
                -->
                <br>
                <br>
                <br>
                <p>12 октября, суббота.</p>
                <p>Начало мероприятия в 10.00. окончание 13.30-14.00.</p>
                <ol>
                    <li>Пройди регистрацию в рекреации на первом этаже, познакомься с программой второго дня мероприятия. 9:30-10:00</li>
                    <li>С 10:00 до 10:45 проведение 1-й линейки студий. Посмотри в личном кабинете на сайте «Коммфорки» информацию про свою студию и проследуй в нужный кабинет. (Найди цвет кружка на сайте рядом с темой студии, который совпадает с цветом кружка, выданного вашей команде волонтерами).</li>
                    <li>С 10:45 до 10:50 электронная рефлексия участников студий. Обсуди результаты участия в первой студии с членами своей группы и оставь комменты на сайте «Коммфорки».</li>
                    <li>С 10:50 до 11:35 проведение 2-й линейки студий. Посмотри в личном кабинете на сайте «Коммфорки» информацию про свою студию и проследуй в нужный кабинет. (Найди цвет кружка на сайте рядом с темой студии, который совпадает с цветом кружка, выданного вашей команде волонтерами).</li>
                    <li>С 11:35 до 12:00 электронная рефлексия участников. Обсуди результаты участия во второй студии с членами своей группы и оставь комменты на сайте «Коммфорки». С 11:35 до 11:50пообедай в столовой на 1 этаже.</li>
                    <li>С 12:00 до 13:30 контрольное испытание - битва комментаторов  «Комментариум», в ходе которого будет проведена оценка умений членов команд комментировать предложенные тексты различной функциональности.</li>
                    <li>С 13:30 завершение второго дня. Подведение итогов мероприятия в актовом зале.</li>
                </ol>
            </div>
        </div>
        <div class="div3">
            <div id="login" class="login">
                <h2>Вход в личный кабинет:</h2>
                <form action="" method="post">
                    <h3>Укажите название своей команды:</h3>
                    <input type="text" name="commandname" placeholder="Название команды" required>
                    <h3>Укажите пароль введённый при регистрации:</h3>
                    <input type="text" name="pass" placeholder="Пароль" required>
                    <h3>Войти в личный кабинет команды!</h3>
                    <input type="submit" name="login" value="Войти!">
                </form>
                <?php
                if($_COOKIE['command_id']!=""){
                echo "<p>Вы уже зашли в аккаунт, нажмите кнопку перейти</p>
                <form action='/my'>
                    <input type='submit' value='Перейти'>
                </form>";
                }
                ?>
            </div>
        </div>
        <div class="div4">
            <div id="registr" class="registr">
                <h2>Регистрация команды:</h2>
                <!--<p>Регистрация завершена.</p>-->
                <form action="" method="post">
                    <h3>Придумайте название своей команды:</h3>
                    <input type="text" name="commandname" placeholder="Название команды" required>
                    <h3>Укажите школу:</h3>
                    <!--
                    <input type="text" name="school" placeholder="Школа" required>
                    -->
                    <label class="radio">
                        <input class="radio" type="radio" name="school" value="2" checked>
                        <span>Лицей №2</span>
                    </label><br>
                    <label class="radio">
                        <input class="radio" type="radio" name="school" value="22">
                        <span>Школа №22</span>
                    </label><br>
                    <label class="radio">
                        <input class="radio" type="radio" name="school" value="10">
                        <span>Гимназия №10</span>
                    </label><br>
                    <!--
                    <input type="radio" name="school" value="55"> 55<br>
                    <input type="radio" name="school" value="22"> 22<br>
                    <input type="radio" name="school" value="10"> 10<br>
                    -->
                    <h3>Перечислите участников:</h3>
                    <input type="text" name="user1" placeholder="Первый участник (Ф.И.)" required>
                    <input type="text" name="user2" placeholder="Второй участник (Ф.И.)" required>
                    <input type="text" name="user3" placeholder="Третий Участник (Ф.И.)" required>
                    <h3>Укажите пароль для дальнейшего входа в личный кабинет:</h3>
                    <input type="text" name="pass" placeholder="Пароль для входа" required>
                    <h3>Проверьте правильность введённых данных и создайте команду!</h3>
                    <input type="submit" name="newcommand" value="Создать команду!">
                </form>
            </div>
        </div>
    </main>
    <footer>
        Коммфорка 2019
    </footer>
</body>
</html>