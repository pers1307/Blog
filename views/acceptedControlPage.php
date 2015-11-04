<div id="HeaderControlPanel" class="container">
    <div class="row">
        <div class="col-md-12">
            <i class="fa fa-wrench"></i>Панель управления контентом блога
        </div>
    </div>
</div>

<div id="ContentControlPanel" class="container">
    <div class="row">

        <div class="col-md-12">
            <div id="New-post">
                <h3>Добавить новую статью в блог!</h3>
                <form role="form" method="post" action="" enctype="multipart/form-data">
                    <?php
                        if ($errorAddArticle['CodeError'] !== '0') {
                            require 'views/Template/errorAddArticle.php';
                        }
                    ?>
                    <div class="form-group col-md-8 <?php if ($errorAddArticle['CodeError'] === '1') echo 'has-error'; ?>">
                        <label for="exampleInputEmail1">Название статьи</label>
                        <input type="text" class="form-control" placeholder="Название статьи" name="NewArticleName">
                    </div>
                    <div class="form-group col-md-4 <?php if ($errorAddArticle['CodeError'] === '2') echo 'has-error'; ?>">
                        <label for="exampleInputPassword1">Автор статьи</label>
                        <input type="text" class="form-control" placeholder="Автор статьи" value="Перескоков Юрий" name="NewArticleAuthor">
                    </div>
                    <div class="form-group col-md-12"<?php if ($errorAddArticle['CodeError'] === '3') echo "style='outline: 1px solid #A90006'"; ?>>
                        <label for="exampleInputFile">Хочу добавить картинку! (Внимание! Картинка не должна быть больше чем 640х425)</label>
                        <input type="file" name="NewArticleImage[]" multiple="multiple">
                    </div>

                    <div class="form-group col-md-12 <?php if ($errorAddArticle['CodeError'] === '4') echo 'has-error'; ?>">
                        <label for="exampleInputFile">Текст статьи: </label>
                        <textarea id="NewArticle" class="form-control" rows="6" name="NewArticleText"></textarea>
                    </div>

                    <div class="form-group">
                        <button id="ForSub" type="submit" class="btn btn-primary" name="Sub"><i class="fa fa-check"></i>Отправить</button>
                    </div>
                </form>
            </div>


            <div id='WrapAccordion'>
                <h3>Редактирование существующих статей</h3>
                <div class="panel-group" id="accordion">
                    <?php
                    $countArticle = $articles->count();
                    for ($count = 0; $count < $countArticle; $count++) {
                        $article = $articles->extract();
                        ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $article->getId(); ?>" class="PostName">
                                        Дата <?php echo $article->getDate(); ?> Название статьи: <?php echo $article->getNameArticle();?>
                                    </a>
                                    <a href='?Delete=<?php echo $article->getId(); ?>' class='btn btn-danger btn-xs'><i class="fa fa-times fa-2x"></i></a>
                                </h4>
                            </div>
                            <div id="<?php echo $article->getId(); ?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>Автор: <?php echo $article-> getAuthor(); ?></p>
                                    <?php echo $article->getTextArticle(); ?>
                                    <div class="Image"><img src="<?php echo $article->getPathImage(); ?>"> </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>