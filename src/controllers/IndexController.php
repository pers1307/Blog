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
    public function searchAction()
    {
        $error = 0;
        $error = $this->checkUser();

        if ($error === 2) {
            $params['user'] = autorization\Autorization::getInstance()->getCurrentUser();

            if ($params['user'] === null) {
                $params['user'] = '';
            }
        }

        $articles = new models\Articles();
        if (isset($_POST['search'])) {
            if ($_POST['search'] === '') {
                header('Location: /');
            }
            $resultSearch['name'] = $articles->likeInName($_POST['search']);
            $resultSearch['text'] = $articles->likeInText($_POST['search']);
            $resultSearch['error'] = 0;
            if (count($resultSearch['name']) === 0 && count($resultSearch['text']) === 0) {
                $resultSearch['error'] = 2;
            }

        } else {
            $resultSearch['error'] = 1;
        }

        $params['content'] = 'views/searchPage.php';
        $params['error'] = $error;
        $params['resultSearch'] = $resultSearch;
        $params['search'] = $_POST['search'];

        echo $this->render('views/general.php', $params);
    }

    public function articleAction($id)
    {
        $error = 0;
        $error = $this->checkUser();

        if ($error === 2) {
            $params['user'] = autorization\Autorization::getInstance()->getCurrentUser();

            if ($params['user'] === null) {
                $params['user'] = '';
            }
        }

        $articles = new models\Articles();
        $article = $articles->findById((int)$id);

        $params['content'] = 'views/articlePage.php';
        $params['error'] = $error;
        $params['article'] = $article;

        echo $this->render('views/general.php', $params);
    }

    public function indexAction()
    {
        $error = 0;
        $error = $this->checkUser();

        if ($error === 2) {
            $params['user'] = autorization\Autorization::getInstance()->getCurrentUser();

            if ($params['user'] === null) {
                $params['user'] = '';
            }
        }

        $currentPage = (int)$this->pager();
        $postOnPage = 3;
        $rez = $this->getArticles($currentPage, (int)$postOnPage);
        $articles = $rez['cutArticles'];
        $articles = $this->cutTextArticle($articles);

        $params['content'] = 'views/contentIndex.php';
        $params['articles'] = $articles;
        $params['error'] = $error;
        $params['page'] = $currentPage;
        $params['countPage'] = $rez['countPage'];

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

            if ($_POST['login'] === '' || $_POST['password'] === '') {
                return 1;
            }
            if (autorization\Autorization::getInstance()->signIn($_POST['login'], $_POST['password'])) {
                autorization\Autorization::getInstance()->setCurrentUser($_POST['login']);
                header('Location: /articlesDesk');

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
     * @param array $articles
     * @return array
     */
    protected function cutTextArticle(array $articles)
    {
        foreach ($articles as $article) {
            if (substr($article->getText(), 320, 1) === ' ') {
                $article->setText(substr($article->getText(), 0, 320) . ' ... ');
            } else {
                $count = 321;
                while(substr($article->getText(), $count, 1) !== ' ') {
                    $count++;
                }
                $article->setText(substr($article->getText(), 0, $count) . ' ... ');
            }
        }

        return $articles;
    }

    /**
     * @return int
     */
    protected function pager()
    {
        if (!isset($_GET['Page'])) {
            return 1;
        } else {
            if ($_GET['Page'] <= 0) {
                return 1;
            } else {
                return $_GET['Page'];
            }
        }
    }

    /**
     * @param int $currentPage
     * @param int $postOnPage
     *
     * @return Array
     * @throws \InvalidArgumentException
     */
    protected function getArticles(&$currentPage, $postOnPage)
    {
        Assert::assert($currentPage, 'currentPage')->notEmpty()->int();
        Assert::assert($postOnPage, 'postOnPage')->notEmpty()->int();

        $res['block'] = '';
        if ($currentPage === 1) {
            $res['block'] = 'start';
        }

        $article = new models\Articles();
        $countArticles = $article->count();

        if ( $currentPage > floor($countArticles / $postOnPage)) {
            $currentPage = ceil($countArticles / $postOnPage);
        }
        $offset = ($currentPage - 1) * $postOnPage;
        $articles = $article->findByLimit((int)$postOnPage, (int)$offset);

        if (count($articles) < $postOnPage) {
            $res['block'] = 'end';
        }

        if ((int)$countArticles === (int)($currentPage * $postOnPage)) {
            $res['block'] = 'end';
        }
        $res['cutArticles'] = $articles;
        $res['countPage'] = ceil($countArticles / $postOnPage);

        return $res;
    }
}