<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Блог Юрия Перескокова</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/font-awesome.css" rel="stylesheet">
    <!--Стили-->
    <link href="/css/main.css" type="text/css" rel="Stylesheet" />
    <link href="/css/controlPanel.css" type="text/css" rel="Stylesheet" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <?php
        require 'views/Template/menu.html';
        require $content;
        //echo $content;
        require 'views/Template/footer.html';
    ?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.js"></script>
<script>
    $(document).ready(function(){

        $('.delete').click(function(event) {
            event.preventDefault();

            var del = $(this).attr("data-delete");

            var route = '/deleteArticle/' + del;

            $.ajax({
                type: "POST",
                url: route,
                data: ({}),
                success: function(data)
                {
                    if (data == 'ArticleDelete') {
                        var str = '#idPost' + del;
                        $(str).fadeOut(500);
                    } else {
                        alert('Произошла ошибка при удалении статьи!');
                    }
                }
            }); // $.ajax
        }); // $('.delete').click

        $('#Submit').click(function() {

            var login = $('#Login').val();
            var password = $('#Password').val();

            $.ajax({
                type: "POST",
                url: "test3.php",
                data: ({ login : login, password : password}),
                success: function(data)
                {
                    console.log(data);
                    data = JSON.parse(data);
                    alert(data.login);
                    alert(data.password);
                    //$('#Form').fadeOut(500);

                    // Появление элементов

                }
            }); // $.ajax

            //return false;
        }); // $('#Submit').submit
    }); // $(document).ready
</script>

</body>
</html>