<?php
/**
 * User.php
 *
 * @category    IndexController
 * @package     Blog
 * @subpackage  Controllers
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     MyLicence
 * @version     1.0
 * @link        https://github.com/pers1307/Blog
 */

namespace pers1307\blog\controllers;

use pers1307\blog\models;

require_once 'src/models/Article.php';

class IndexController
{
    public function index()
    {
        $this->deleteSessionUser();
        $article = new models\Article();
        $articles = $article->findAll();
        $ContentType = 'Index';
        $this->render('views/Template/general.php', $ContentType, $articles);
    }

    protected function render($templateFile, $ContentType, $articles)
    {
        ob_start();
        ob_implicit_flush(false);
        require $templateFile;
    }

    protected function deleteSessionUser()
    {
        session_start();

        if (isset($_SESSION['User'])) {
            unset($_SESSION['User']);
        }

        if (isset($_SESSION['Password'])) {
            unset($_SESSION['Password']);
        }
    }
}