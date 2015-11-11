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
            <a href="/articlesDesk" class="btn btn-primary"><i class="fa fa-reply"></i>  Вернуться к статьям</a>
            <div id="New-post">
                <h3>Редактирование статьи</h3>
                <form role="form" method="post" action="/EditArticle?Edit=<?php echo $article->getId(); ?>" enctype="multipart/form-data">
                    <?php
                    if ($errorAddArticle['CodeError'] !== '0') {
                        require 'views/Template/errorAddArticle.php';
                    }
                    ?>
                    <div class="form-group col-md-8 <?php if ($errorAddArticle['CodeError'] === '1') echo 'has-error'; ?>">
                        <label for="exampleInputEmail1">Название статьи</label>
                        <input type="text" class="form-control" placeholder="Название статьи" name="NewArticleName" value="<?php echo $article->getName(); ?>">
                    </div>
                    <div class="form-group col-md-4 <?php if ($errorAddArticle['CodeError'] === '2') echo 'has-error'; ?>">
                        <label for="exampleInputPassword1">Автор статьи</label>
                        <input type="text" class="form-control" placeholder="Автор статьи" value="<?php echo $article->getAuthor(); ?>" name="NewArticleAuthor">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="exampleInputFile">Текущая картинка: </label>
                        <div class="Image"><img src="<?php echo $article->getPathImage(); ?>" width="100%"> </div>
                    </div>

                    <div class="form-group col-md-12"<?php if ($errorAddArticle['CodeError'] === '3') echo "style='outline: 1px solid #A90006'"; ?>>
                        <label for="exampleInputFile">Хочу добавить другую картинку!</label>
                        <input type="file" name="NewArticleImage[]" multiple="multiple">
                    </div>

                    <div class="form-group col-md-12 <?php if ($errorAddArticle['CodeError'] === '4') echo 'has-error'; ?>">
                        <label for="exampleInputFile">Текст статьи: </label>
                        <textarea id="NewArticle" class="form-control" rows="19" name="NewArticleText"><?php echo $article->getText(); ?></textarea>
                    </div>

                    <div class="form-group">
                        <button id="ForSub" type="submit" class="btn btn-primary" name="Sub"><i class="fa fa-check"></i>Отправить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>