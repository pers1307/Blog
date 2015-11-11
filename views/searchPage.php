<div id="Header" class="container">
    <div class="row">
        <div class="col-md-12">
            Блог начинающего PHP - разработчика
        </div>
    </div>
</div>

<div class="container" id="containerForSearch">
    <div class="row">
        <div class="col-md-9">

            <form class="form-inline" role="form" action="/Search" method="post">
                <div class="form-group">
                    <label class="sr-only" for="exampleInputEmail2"></label>
                    <input type="text" class="form-control" placeholder="Поиск ... " name="search" value="<?php echo $search; ?>">
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </form>

        </div>
    </div>
</div>

<div id="Content" class="container">
    <div class="row">
        <div class="col-md-9">
            <h2>Результаты поиска</h2>
            <?php
                if ($resultSearch['error'] === 1 || $resultSearch['error'] === 2) {
                    if ($resultSearch['error'] === 2) {
                        echo 'Ничего не найдено!';
                    } else {
                        echo 'Запрос отсутствует!';
                    }
                } else {
            ?>
            <h2>Найдено в названии статьи: </h2>
            <?php
                foreach ($resultSearch['name'] as $article) { ?>
                    <p><a href="/Article/<?php echo $article->getId(); ?>">
                        Название статьи: <?php echo $article->getName(); ?>;
                        Дата: <?php echo $article->getCreatedAt(); ?>;
                        Автор: <?php echo $article->getAuthor(); ?>
                    </a></p>
             <?php } ?>


            <h2>Найдено в тексте статьи: </h2>
            <?php
            foreach ($resultSearch['text'] as $article) { ?>
                <p><a href="/Article/<?php echo $article->getId(); ?>">
                        Название статьи: <?php echo $article->getName(); ?>;
                        Дата: <?php echo $article->getCreatedAt(); ?>;
                        Автор: <?php echo $article->getAuthor(); ?>
                    </a></p>
            <?php } ?>

            <?php } ?>
        </div>

        <div class="col-md-2 col-md-offset-1">
            <p id="MyPhoto"><img src="/img/photo.jpg" width="100" height="150" alt="Хозяин блога"></p>

            <?php if ($error === 1) require 'views/Template/alertFalseLogin.html'; ?>

            <?php
            if ($error !== 2) {
                require 'views/Template/autorizationForm.html';
            } else {
                require 'views/Template/autorization.php';
            }
            ?>

        </div>
    </div>
</div>