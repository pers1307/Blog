<div id="content">
    <?php
        if ($formOnPage == 'Welcome') {
            echo "
            <p>Добро пожаловать: $loginAdmin</p>
            <a href='ControlContent.php'>Перейти в CMS сайта</a>
            ";
        } elseif ($formOnPage == 'Form') {
            echo "
                 <fieldset>
                     <legend>Форма Авторизации</legend>
                         <form method='post' enctype='multipart/form-data'>
                             Логин администратора:<br/>
                                <input class='text' type='text' name='login' /> <br/>
                             Пароль:<br/>
                                 <input class='text' type='password' name='password' /> <br/>
                                 <input id='Submit' type='submit' value='Войти'/>
                         </form>
                 </fieldset>
                 ";
        } else {
            echo '<p>Логин или пароль введен не правильно</p>';
        }
    ?>
</div>