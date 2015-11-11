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

            <?php if ($article === null) { ?>
                <div id="NoArticle"><h1>Такой статьи не существует!</h1><h1>Давай, досвидания!</h1></div>
            <?php } else { ?>
                <div class="Block-post">
                    <h2 class="blog-post-title"><?php echo $article->getName();?></h2>
                    <p class="blog-post-meta">
                        <?php echo $article->getCreatedAt(); ?> by <span class="blog-post-autor"><?php echo $article-> getAuthor(); ?></span>
                    </p>
                    <hr>
                    <div class="Image"><img src="<?php echo '/' . $article->getPathImage(); ?>" width="100%"> </div>
                    <div class="blog-post-text">
                        <?php echo $article->getText(); ?>
                    </div>
                </div>
                <?php } ?>
            <p></p>
            <a href="/" class="btn btn-primary"><i class="fa fa-share fa-rotate-180"></i>  Вернуться на главую!</a>
            <p></p>
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