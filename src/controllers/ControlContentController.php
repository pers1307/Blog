<?php
/**
 * User.php
 *
 * @category    ControlContentController
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
require_once 'src/models/User.php';

class ControlContentController
{
    public function controlContent()
    {
        $ContentType = 'ControlContent';
        $status = $this->checkAutorization();
        $article = new models\Article();
        if (isset($_POST['NewArticleName']) && isset($_POST['NewArticleText'])) {
            $article->insert($_POST['NewArticleName'], $_POST['NewArticleText']);
            unset($_POST['NewArticleName'], $_POST['NewArticleText']);
        }

        if (isset($_GET['Delete'])) {
            $article->deleteByid(abs((int)$_GET['Delete']));
            unset($_GET['Delete']);
        }
        $articles = $article->findAll();
        $this->render('views/Template/general.php', $ContentType, $status, $articles);
    }

    protected function render($templateFile, $ContentType, $status, $articles)
    {
        ob_start();
        ob_implicit_flush(false);
        require $templateFile;
    }

    protected function checkAutorization()
    {
        session_start();
        if (isset($_SESSION['User']) && isset($_SESSION['Password'])) {
            $user = new models\User();
            if ($user->findByCreditionals($_SESSION['User'], $_SESSION['Password'])) {
                return 'Accept';
            } else {
                return 'Unaccept';
            }
        } else {
            return 'Error';
        }
    }
}