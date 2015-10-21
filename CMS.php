<?php

    session_start();
    require_once 'classes/AutorizationAdmin.php';
    require_once 'classes/Work_for_Articles_Class.php';

    $errors = 0;

    $autoAdmin = new AutorizationAdmin();

    if(isset($_SESSION['Admin']) && isset($_SESSION['Password'])) {
        if(!$autoAdmin->CheckAdministrator($_SESSION['Admin'],$_SESSION['Password'])) {
            $errors = 2;
        }
    } else
        $errors = 1;

    $myArticles = new Pereskokov\Work_for_Articles_Class();

    if(isset($_POST['NewArticleName']) && isset($_POST['NewArticleText'])) {
        $myArticles->AddNewArticle($_POST['NewArticleName'],$_POST['NewArticleText']);
        unset($_POST['NewArticleName'],$_POST['NewArticleText']);
    }

    if(isset($_GET['Delete'])) {
        $myArticles->DeleteArticle(abs((int)$_GET['Delete']));
        unset($_GET['Delete']);
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
    <link href="css/cms.css" type="text/css" rel="Stylesheet" />
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="js/Accordion.js" type="text/javascript"></script>
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
            if($errors == 0) {
                echo("
                     <h1 id='Welcome' >Добро пожаловать панель управления контентом сайта</h1>
                        <fieldset>
                            <legend>
                                Дабавление статьи в блог
                            </legend>

                            <form method='post' name='NewArticleText'>

                                <p id='Top'>Название статьи:</p>
                                <input id='ForTeam' type='text' name='NewArticleName'/>

                                <p id='Top'>Текст статьи:</p>
                                <textarea id='NewArticle' name='NewArticleText' rows='25' cols='100'></textarea>
                                <br />

                                <input id='Submit' type='submit' name='submit' value='Отправить'>
                            </form>
                        </fieldset>

                        <h1 id='Welcome' >Редактирование существующих статей</h1>

                        <div id='WrapAccordion'>
                            <div id='accordion'>
                    ");

                $myArticles->GetAllArticlesFromDB();

                for($count = 0; $count < $myArticles->count ;$count++) {
                    $article = $myArticles->GetNextArticle();

                    echo("<h3>".$article['Date']." ".$article['ArticleName']."</h3><div><p>");
                    echo($article['Article']."<a href='?Delete=".$article['id']."' class='X'>Удалить статью</a></p></div>");
                }
                echo("</div></div>");
            } elseif($errors == 1) {
                echo("<h1 id='Welcome'>У вас нет прав доступа к этой стронице! Пожалуйста, авторизируйтесь.</h1>");
            } else {
                echo("<h1 id='Welcome'>Логин или пароль введен не верно!</h1>");
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