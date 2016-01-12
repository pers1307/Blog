<?php
/**
 * ArticlesDeskController.php
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
use pers1307\blog\services\Autorization;
use pers1307\blog\entity\Article;
use pers1307\blog\services\Log;
use KoKoKo\assert\Assert;

class ArticlesDeskController extends AbstractController
{
    /**
     * @return array
     * @throws \InvalidArgumentException
     */
    public function editArticleAction()
    {
        $request = Request::createFromGlobals();
        $response = new Response(
            'Content',
            Response::HTTP_OK,
            ['content-type' => 'text/html']
        );

        try {

            if (!Autorization::getInstance()->checkAutorization()) {
                $params = [
                    'forContent' => 'template/alertAutorization.html',
                    'message' => 'У вас нет доступа к этой странице. Пожалуйста, авторизируйтесь.'
                ];

                $response->setContent($this->renderByTwig('layoutFilled.html', $params));
                $response->send();
            }

            if ($request->query->has('articleId')) {
                $params = [
                    'forContent' => 'template/alertAutorization.html',
                    'message' => 'Такой статьи не существует.'
                ];

                $response->setContent($this->renderByTwig('layoutFilled.html', $params));
                $response->send();
            }

            $id = $request->query->get('articleId');
            $id = Assert::assert($id, 'id')->digit($id)->toInt()->get();
            $modelArticle = new ArticleRepository();
            $article = $modelArticle->findById($id);

            if ($article === null) {
                throw new \Exception(
                    'Такой статьи не существует.'
                );
            }

            $errorAddArticle = $this->editArticle($article);
            $params = [
                'article' => $article,
                'errorAddArticle' => $errorAddArticle,
            ];
            $params['forContent'] = 'editArticle.html';

            $response->setContent($this->renderByTwig('layoutFilled.html', $params));
            $response->send();
        } catch (\Exception $exception) {
            $params = [
                'forContent' => 'template/alert.html',
                'message' => $exception->getMessage()
            ];

            $response->setContent($this->renderByTwig('layoutFilled.html', $params));
            $response->send();
        }
    }

    public function findAllAction()
    {
        $response = new Response(
            'Content',
            Response::HTTP_OK,
            ['content-type' => 'text/html']
        );

        try {
            if (!Autorization::getInstance()->checkAutorization()) {
                throw new \Exception(
                    'У вас нет доступа к этой странице. Пожалуйста, авторизируйтесь.'
                );
            }
            /**
             * todo: сделать возврат данных на форму. Либо сделать обработку формы на Ajax, и вынести эту форму на отдельную страницу.
             */
            $addResult = $this->addArticle();
            $article = new ArticleRepository();
            $articles = $article->findAll();
            $params = [
                'articles' => $articles,
                'addResult' => $addResult,
                'forContent' => 'articleDesk.html'
            ];

            $response->setContent($this->renderByTwig('layoutFilled.html', $params));
            $response->send();

        } catch (\Exception $exception) {
            $params = [
                'forContent' => 'template/alert.html',
                'message' => $exception->getMessage()
            ];

            $response->setContent($this->renderByTwig('layoutFilled.html', $params));
            $response->send();
        }
    }

    /**
     * Я этот метод переделал, но мне не понятно, как сделать прослойку между исключениями для программиста и исключениями для пользователя?
     * Можно, конечно, написать что-то в стиле "Что-то пошло не так", но это может быть по вине пользователя, ибо поля не должны быть пустыми.
     * Мне только приходит в голову, сделать конфиг, с сопоставлением исключений системных с пользовательскими.
     *
     * @return Array
     *
     * @throws \InvalidArgumentException|\Exception
     */
    protected function addArticle()
    {
        $request = Request::createFromGlobals();

        $preArticle = [];

        try {
            if (!$request->request->has('newArticleName')) {
                throw new \InvalidArgumentException('Аргумент "newArticleName" на задан в POST массиве');
            }
            $preArticle['name'] = htmlspecialchars($request->request->get('newArticleName'));

            if (!$request->request->has('newArticleText')) {
                throw new \InvalidArgumentException('Аргумент "newArticleText" на задан в POST массиве');
            }
            $preArticle['text'] = htmlspecialchars($request->request->get('newArticleText'));

            if (!$request->request->has('newArticleAuthor')) {
                throw new \InvalidArgumentException('Аргумент "newArticleAuthor" на задан в POST массиве');
            }
            $preArticle['author'] = htmlspecialchars($request->request->get('newArticleAuthor'));

            $name = null;
            $tmp = null;

            foreach ($request->files as $uploadedFile) {
                foreach ( $uploadedFile as $item) {
                    $name = $item->getClientOriginalName();
                    $item->move('img', $name);
                }
            }

            if ($name === null) {
                throw new \Exception(
                    'Картинка не выбрана!'
                );
            }
            $preArticle['pathImage'] = 'img/' . $name;

            $article = new Article();
            $article->fromArray($preArticle);

            (new ArticleRepository())->insert($article);

        } catch (\Exception $exception) {
            return [
                'TextError' => $exception->getMessage(),
                'article' => $preArticle
            ];
        }
    }
    /**
     * @param Article $article
     *
     * @return Array
     */
    protected function editArticle(Article $article)
    {
        // Здесь та же проблема!
        if (isset($_POST['NewArticleName']) && isset($_POST['NewArticleText']) && isset($_POST['NewArticleAuthor'])) {

            if ($_POST['NewArticleName'] === '') {
                return $this->setErrors('1', 'Название статьи не может быть пустым!');
            }

            if ($_POST['NewArticleAuthor'] === '') {
                return $this->setErrors('2', 'Статья не может быть без автора!');
            }
            $pathImage = '';

            if (isset($_FILES['NewArticleImage'])) {
                if ($_FILES['NewArticleImage']['name']['0'] === '') {
                    $pathImage = $article->getPathImage();
                }
            } else {
                if ($article->getPathImage() === '') {
                    return $this->setErrors('3', 'Картинка не выбрана!');
                } else {
                    $pathImage = $article->getPathImage();
                }
            }

            if ($_POST['NewArticleText'] === '') {
                return $this->setErrors('4', 'Текст статьи не может быть пустым!');
            }
            $articles = new ArticleRepository();

            if ($pathImage === '') {
                copy($_FILES['NewArticleImage']['tmp_name']['0'], 'img/' . $_FILES['NewArticleImage']['name']['0']);
                $pathImage = 'img/'.$_FILES['NewArticleImage']['name']['0'];
            }
            $article->setName($_POST['NewArticleName'])
                ->setAuthor($_POST['NewArticleAuthor'])
                ->setText($_POST['NewArticleText'])
                ->setPathImage($pathImage);
            $articles->updateById($article);
            unset($_POST['NewArticleName'], $_POST['NewArticleText'], $_POST['NewArticleAuthor'], $_POST['NewArticleImage']);

            return $this->setErrors('0', '');
        } else {
            unset($_POST['NewArticleName'], $_POST['NewArticleText'], $_POST['NewArticleAuthor'], $_POST['NewArticleImage']);

            return $this->setErrors('0', '');
        }
    }
    /**
     * todo: Удалить этот метод после перехода на Исключения
     * @param string code
     * @param string $text
     * @param ArticleRepository $article|null
     *
     * @return Array
     * @throws \InvalidArgumentException
     */
    protected function setErrors($code, $text, $article = null)
    {
        Assert::assert($code, 'code')->string();
        Assert::assert($text, 'text')->string();
        $errors['TextError'] = $text;
        $errors['CodeError'] = $code;
        $errors['Article'] = $article;

        return $errors;
    }

    /**
     * @param int $id
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    public function deleteArticle($id)
    {
        try {
            $id = Assert::assert($id, 'id')->digit()->toInt()->get();
            $articles = new ArticleRepository();
            $articles->deleteById($id);
        } catch (\Exception $e) {
            return 'ArticleNotDelete';
        }

        return 'ArticleDelete';
    }
}