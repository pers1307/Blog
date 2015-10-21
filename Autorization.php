<?php

require_once 'classes/AutorizationAdmin.php';

session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Блог Перескокова Юрия</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!--Стили-->
    <link href="css/main.css" type="text/css" rel="Stylesheet" />
    <link href="css/AutorizationCSS.css" type="text/css" rel="Stylesheet" />
</head>
<body>
<div id="wrapper">
    <div id="header">
        <div id="img"><img src="img/blog.jpg" width="160" height="106" alt=""></div>
        <h1 id="NameBlog">Блог начинающего PHP - разработчика</h1>
    </div>
    <div id="menu">
        <ul>
            <li><a href="index.php">Главная</a></li>
            <li><a href="Autorization.php">Вход для администратора</a></li>
            <li><a href="#">Скачать код блога</a></li>
            <li><a href="#footer">Контакты</a></li>
        </ul>
    </div>
    <div id="content">
        <?php
        try
        {
            if (isset($_POST['login']) && isset($_POST['password'])) {
                $loginAdmin = $_POST['login'];
                $passwordAdmin = $_POST['password'];

                $autoAdmin = new AutorizationAdmin();

                if($autoAdmin->CheckAdministrator($loginAdmin,$passwordAdmin)) {
                    echo("<p>Добро пожаловать: ".$loginAdmin."</p>");
                    echo("<a href='CMS.php'>Перейти в CMS сайта</a>");

                    $_SESSION['Admin'] = $loginAdmin;
                    $_SESSION['Password'] = $passwordAdmin;
                }
                else
                {
                    echo("<p>Логин или пароль введен не правильно</p>");
                }
            }
            else
            {
                echo("
                <fieldset>
                <legend>Форма Авторизации</legend>
                    <form method='post' enctype='multipart/form-data'>
                        Логин администратора:<br/>
                        <input class='text' type='text' name='login' /> <br/>
                        Пароль:<br/>
                        <input class='text' type='password' name='password' /> <br/>
                        <input id='Submit' type='submit' value='Войти'/>
                    </form>
                </fieldset>
                ");
            }
        }
        catch(Exception $excep)
        {

        }
        ?>
    </div>
    <div id="footer">
        <p>&copy; Дизайн - собственность Перескокова Юрия</p>
        <p>&copy; CMS - собственность Перескокова Юрия</p>
        <p>Почта: skulines@mail.ru</p>
    </div>
</div>
</body>
</html>


