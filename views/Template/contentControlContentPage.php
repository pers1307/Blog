<div id="content">
        <?php
        if ($status == 'Accept') {
            echo "
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
                 ";

            for ($count = 0; $count < count($articles); $count++) {
                echo '<h3>' . $articles[$count]['Date'] . ' ' . $articles[$count]['ArticleName'] . '</h3><div><p>';
                echo $articles[$count]['ArticleText'] . "<a href='?Delete=" . $articles[$count]['id'] . "' class='X'>Удалить статью</a></p></div>";
            }
            echo "</div></div>";
        }

        if ($status == 'Unaccept') {
            echo "<h1 id='Welcome'>У вас нет прав доступа к этой стронице! Пожалуйста, авторизируйтесь.</h1>";
        }

        if ($status == 'Error') {
            echo "<h1 id='Welcome'>Логин или пароль введен не верно!</h1>";
        }
        ?>
</div>