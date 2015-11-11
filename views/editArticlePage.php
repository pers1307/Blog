<?php

if ((int)$error === 1) {
    require 'views/Template/alertEditPage.html';
} else {
    require 'views/Template/editArticleForm.php';
}