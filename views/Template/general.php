<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Блог Перескокова Юрия</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!--Стили-->
    <link href="css/main.css" type="text/css" rel="Stylesheet" />
    <link href="css/autorization.css" type="text/css" rel="Stylesheet" />
    <link href="css/controlContent.css" type="text/css" rel="Stylesheet" />
    <!--Скрипты -->
    <script src="js/jq/jquery-1.8.3.js" type="text/javascript"></script>
    <script src="js/accordion.js" type="text/javascript"></script>
</head>
<body>
<div id="wrapper">
    <?php
        require 'views/Template/header.html';
        require 'views/Template/menu.html';

        switch($ContentType) {
            case "Index":
                require 'views/Template/contentIndex.php';
                break;
            case "Autorization":
                require 'views/Template/contentAutorizationPage.php';
                break;
            case "ControlContent":
                require 'views/Template/contentControlContentPage.php';
                break;
            default:
        }
        require 'views/Template/footer.html';
    ?>
</div>
</body>
</html>