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

use pers1307\blog\autorization\Autorization;
use KoKoKo\assert\Assert;
use pers1307\blog\repository\ArticleRepository;


class IndexController extends Controller
{
    public function indexAction()
    {
        $error = 0;
        $error = $this->checkUser();

        if ($error === 2) {
            $params['user'] = Autorization::getInstance()->getCurrentUser();

            if ($params['user'] === null) {
                $params['user'] = '0';
            }
        }

        $currentPage = (int)$this->pager();
        $postOnPage = 3;
        $rez = $this->getArticles($currentPage, (int)$postOnPage);
        $articles = $rez['cutArticles'];

        $params = [
            'articles' => $articles,
            'error' => $error,
            'page' => $currentPage,
            'countPage' => $rez['countPage'],
            'forContent' => 'index.html'
        ];

        echo $this->renderByTwig('layoutFilled.html', $params);
    }

    /**
     * @return int
     */
    protected function checkUser()
    {
        if (isset($_GET['Exit'])) {
            Autorization::getInstance()->exitSession();
        }

        if (isset($_POST['login']) && isset($_POST['password'])) {

            if ($_POST['login'] === '' || $_POST['password'] === '') {
                return 1;
            }
            if (Autorization::getInstance()->signIn($_POST['login'], $_POST['password'])) {
                Autorization::getInstance()->setCurrentUser($_POST['login']);
                header('Location: /articlesDesk');

                exit();
            } else {
                return 1;
            }
        }

        if (Autorization::getInstance()->checkAutorization() === false) {
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

        $article = new ArticleRepository();
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