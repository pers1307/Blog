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

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use pers1307\blog\repository\ArticleRepository;
use pers1307\blog\service\Autorization;
use pers1307\blog\repository\UserRepository;
use KoKoKo\assert\Assert;

class IndexController extends AbstractController
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

        if (empty($articles)) {
            $currentPage = 0;
        }

        $params = [
            'articles' => $articles,
            'error' => $error,
            'page' => $currentPage,
            'countPage' => $rez['countPage'],
            //'user' => $user,
            'forContent' => 'index.html'
        ];

        // Не понятно, как сделать выводить $response вне контроллера
        $response = new Response(
            'Content',
            Response::HTTP_OK,
            ['content-type' => 'text/html']
        );
        $response->setContent($this->renderByTwig('layoutFilled.html', $params));
        $response->send();
    }

    /**
     * @return int
     */
    protected function checkUser()
    {
        $request = Request::createFromGlobals();

        if ($request->query->has('exit')) {
            Autorization::getInstance()->exitSession();
        }
        if ($request->request->has('login') && $request->request->has('password')) {
            if ($request->request->get('login') === '' || $request->request->get('password') === '') {
                return 1;
            }

            if (Autorization::getInstance()->signIn($request->request->get('login'), $request->request->get('password'))) {
                $user = (new UserRepository())->findByCreditionals($request->request->get('login'));
                Autorization::getInstance()->setCurrentUserId($user->getId());
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
        $request = Request::createFromGlobals();

        if ($request->query->has('page')) {
            return 1;
        } else {
            if ($request->query->get('page') <= 0) {
                return 1;
            } else {
                return $request->query->get('page');
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

        if ($currentPage > floor($countArticles / $postOnPage)) {
            $currentPage = ceil($countArticles / $postOnPage);
        }
        $offset = ($currentPage - 1) * $postOnPage;
        if ($offset < 0) {
            $offset = 0;
        }
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