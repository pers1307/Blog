<div id="Header" class="container">
    <div class="row">
        <div class="col-md-12">
            Блог начинающего PHP - разработчика
        </div>
    </div>
</div>

<div id="Content" class="container">
    <div class="row">
        <div class="col-md-9">

            <?php
                $countArticle = $articles->count();
                for ($count = 0; $count < $countArticle; $count++) {
                    $article = $articles->extract();
            ?>
            <div class="Block-post">
                <h2 class="blog-post-title"><?php echo $article->getNameArticle();?></h2>
                    <p class="blog-post-meta">
                        <?php echo $article->getDate(); ?> by <span class="blog-post-autor"><?php echo $article-> getAuthor(); ?></span>
                    </p>
                <hr>
                <div class="blog-post-text">
                    <?php echo $article->getTextArticle(); ?>
                </div>
                <div class="Image"><img src="<?php echo $article->getPathImage(); ?>"> </div>
            </div>
            <?php } ?>

            <div id="Pager">
                <div class="btn-group btn-group-lg">
                    <?php
                        if ($pagerBlock !== 'start') {
                            echo "<a href='?Page=prev&CurrentPage=$currentPage' class='btn btn-primary'>Назад</a>";
                        }
                    ?>
                    <a href="#" class="btn btn-primary active"><?php echo $currentPage; ?></a>
                    <?php
                    if ($pagerBlock !== 'end') {
                        echo "<a href='?Page=next&CurrentPage=$currentPage' class='btn btn-primary'>Вперед</a>";
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="col-md-2 col-md-offset-1">
            <p id="MyPhoto"><img src="img/photo.jpg" width="100" height="150" alt="Хозяин блога"></p>

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