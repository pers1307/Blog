<?php

namespace Pereskokov;

require_once 'classes/Work_for_Articles_Class.php';

session_start();

if(isset($_SESSION['Admin'])) {
    unset($_SESSION['Admin']);
}

if(isset($_SESSION['Password'])) {
    unset($_SESSION['Password']);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Блог Перескокова Юрия</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!--Стили-->
    <link href="css/main.css" type="text/css" rel="Stylesheet" />
    <!--Скрипты -->
    <script src="js/jq/jquery-1.8.3.js" type="text/javascript"></script>
    <!--<script src="js/EqualHeightForColon.js" type="text/javascript"></script>-->
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
                <li><a href="Download/blog.rar">Скачать код блога</a></li>
                <li><a href="#footer">Контакты</a></li>
            </ul>
        </div>
        <div id="content">
            <div id="LeftSideBar">
                <div id="MyPhoto"><img src="img/photo.jpg" width="100" height="150" alt=""></div>
                <a id="Enter" href="Autorization.php">Вход</a>
            </div>
            <div id="blog">

                <?php
                    $myArticles = new Work_for_Articles_Class();

                    $myArticles->GetAllArticlesFromDB();

                    for($count = 0; $count < $myArticles->count ;$count++) {
                        $article = $myArticles->GetNextArticle();

                        echo("<div class='Record'>");
                        echo("<h2>".$article['ArticleName']." Дата: ".$article['Date']."</h2>");
                        echo("<p>".$article['Article']."</p>");
                        echo("<div class='line'></div></div>");
                    }
                ?>
            </div>
        </div>
        <div id="footer">
            <p>&copy; Дизайн - собственность Перескокова Юрия</p>
            <p>&copy; CMS - собственность Перескокова Юрия</p>
            <p>Почта: skulines@mail.ru</p>
        </div>
    </div>
</body>
</html>
