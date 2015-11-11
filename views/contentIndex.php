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
                    <label class="sr-only" for="exampleInputEmail2">Email</label>
                    <input type="text" class="form-control" placeholder="Поиск ... " name="search">
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </form>

        </div>
    </div>
</div>

<div id="Content" class="container">
    <div class="row">
        <div class="col-md-9">

            <?php
                foreach ($articles as $article) {
            ?>
            <div class="Block-post">
                <h2 class="blog-post-title"><?php echo $article->getName();?></h2>
                    <p class="blog-post-meta">
                        <?php echo $article->getCreatedAt(); ?> by <span class="blog-post-autor"><?php echo $article-> getAuthor(); ?></span>
                    </p>
                <hr>
                <div class="Image"><img src="<?php echo $article->getPathImage(); ?>" width="100%"> </div>
                <div class="blog-post-text">
                    <?php echo $article->getText(); ?>
                    <a href="/Article/<?php echo $article->getId(); ?>"> Хочу знать больше!</a>
                </div>
            </div>
            <?php } ?>

            <!-- Новая паджинация  -->
            <ul class="pagination pagination-lg">
                <?php
                if ((int)$page !== 1) {
                    $prevPage = $page - 1;
                    echo "<li><a href='?Page=$prevPage'>&laquo;</a></li>";
                }

                for ($count = 1; $count < $countPage + 1; $count++) {
                    if ( (int)$page === (int)$count) {
                        echo "<li class='active'><a href='?Page=$count'>$count</a></li>";
                    } else {
                        echo "<li><a href='?Page=$count'>$count</a></li>";
                    }
                }

                if ((int)$page !== (int)$countPage) {
                    $nextPage = $page + 1;
                    echo "<li><a href='?Page=$nextPage'>&raquo;</a></li>";
                }
                ?>
            </ul>
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