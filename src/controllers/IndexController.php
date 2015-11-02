<?php
/**
 * IndexController.php
 *
 * @category    IndexController
 * @package     Blog
 * @subpackage  Controllers
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @version     2.0
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\controllers;

use pers1307\blog\models;
use pers1307\blog\autorization;

require_once 'src/models/Articles.php';
require_once 'src/models/Users.php';
require_once 'src/controllers/Controller.php';
require_once 'src/autorization/Autorization.php';

class IndexController extends Controller
{
    public function index()
    {
        $error = 0;
        $error = $this->checkUser();

        if ($error === 2) {
            $params['user'] = autorization\Autorization::getInstance()->getCurrentUser();
        }

        $article = new models\Articles();
        $articles = $article->findAll();

        $currentPage = $this->pager();
        $rez = $this->cutArticle($currentPage, $articles);
        $articles = $rez['cutArticles'];

        $params['content'] = 'views/contentIndex.php';
        $params['articles'] = $articles;
        $params['error'] = $error;
        $params['pagerBlock'] = $rez['block'];
        $params['currentPage'] = $currentPage;

        echo $this->render('views/general.php', $params);
    }

    protected function checkUser()
    {
        if (isset($_GET['Exit'])) {
            autorization\Autorization::getInstance()->exitSession();
        }

        if (isset($_POST['login']) && isset($_POST['password'])) {
            if (autorization\Autorization::getInstance()->authentication($_POST['login'], $_POST['password'])) {
                autorization\Autorization::getInstance()->setCurrentUser($_POST['login']);
                header('Location: content.php');
                exit();
            } else {
                return 1;
            }
        }

        if (autorization\Autorization::getInstance()->checkAutorization() === false) {
            return 0;
        } else {
            return 2;
        }
    }

    protected function pager()
    {
        if (!isset($_GET['Page'])) {
            return 1;
        } elseif (isset($_GET['CurrentPage'])) {
            if ($_GET['Page'] === 'next') {
                return $_GET['CurrentPage'] + 1;
            } else {
                return $_GET['CurrentPage'] - 1;
            }
        }
    }

    protected function cutArticle($currentPage, $articles)
    {
        $postOnPage = 3;
        $res['block'] = '';
        $res['cutArticles'] = new \SplMinHeap();

        if ($currentPage === 1) {
            $res['block'] = 'start';
        }

        $countArticles = $articles->count();
        for ($count = 0; $count < ($currentPage - 1) * $postOnPage; $count++) {
            $art = $articles->extract();
        }

        for ($count = ($currentPage - 1) * $postOnPage; $count < $postOnPage * $currentPage; $count++) {

            if ($count < $countArticles) {
                $art = $articles->extract();
                $res['cutArticles']->insert($art);
            } else {
                break;
            }
        }

        if ($res['cutArticles']->count() < $postOnPage) {
            $res['block'] = 'end';
        } elseif (!$articles->valid()) {
            $res['block'] = 'end';
        }

        return $res;
    }
}