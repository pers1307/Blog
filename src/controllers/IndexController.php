<?php
/**
 * IndexController.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\controllers;

use pers1307\blog\models;
use pers1307\blog\autorization;
use KoKoKo\assert\Assert;

class IndexController extends Controller
{
    /**
     *
     */
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

    /**
     * @return int
     */
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

    /**
     * @return int
     */
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

    /**
     * @param string      $currentPage
     * @param \SplMinHeap $articles
     *
     * @return \SplMinHeap
     * @throws Exception
     */
    protected function cutArticle($currentPage, $articles)
    {
        Assert::assert($currentPage, 'currentPage')->notEmpty()->int();
        if (gettype($articles) !== 'object') {

            throw new Exception('articles in IndexController->cutArticle is not a object!');
        }

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