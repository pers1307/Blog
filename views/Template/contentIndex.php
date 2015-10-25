<div id="content">
    <div id="LeftSideBar">
        <div id="MyPhoto"><img src="img/photo.jpg" width="100" height="150" alt=""></div>
        <a id="Enter" href="Autorization.php">Вход</a>
    </div>
    <div id="blog">
        <?php
            for ($count = 0; $count < count($articles); $count++) {
                echo "<div class='Record'>";
                echo '<h2>' . $articles[$count]['ArticleName'] . ' Дата: ' . $articles[$count]['Date'] . '</h2>';
                echo '<p>' . $articles[$count]['ArticleText'] . '</p>';
                echo "<div class='line'></div></div>";
            }
        ?>
    </div>
</div>
