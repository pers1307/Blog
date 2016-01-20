<?php
/**
 * ArticleController.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\controllers;

use pers1307\blog\exception\InvalidAutorizationException;
use pers1307\blog\exception\NoPostArgumentException;
use pers1307\blog\exception\EmptyParameterException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use pers1307\blog\repository\ArticleRepository;
use pers1307\blog\repository\UserRepository;
use pers1307\blog\service\Autorization;
use pers1307\blog\service\Log;
use KoKoKo\assert\Assert;

class ArticleController extends AbstractController
{
    /** @return Response */
    public function displayAction()
    {
        try {
            if (!Autorization::getInstance()->checkAutorization()) {
                throw new InvalidAutorizationException(
                    'У вас нет доступа к этой странице. Пожалуйста, авторизируйтесь.'
                );
            }

            $params = [
                'forContent' => 'article.html'
            ];

            $response = new Response(
                'Content',
                Response::HTTP_OK,
                ['content-type' => 'text/html']
            );
            $response->setContent($this->renderByTwig('layoutFilled.html', $params));

            return $response;

        } catch (InvalidAutorizationException $exception) {
            $params = [
                'forContent' => 'template/alert.html',
                'message' => $exception->getMessage()
            ];

            Log::getInstance()->addError(
                'Исключение в ArticleController->displayAction : ' . $exception->getMessage()
            );

            $response = new Response(
                'Content',
                Response::HTTP_OK,
                ['content-type' => 'text/html']
            );
            $response->setContent($this->renderByTwig('layoutFilled.html', $params));

            return $response;
        }
    }

    /**
     * @return Array
     *
     * @throws \InvalidArgumentException|\Exception
     */
    public function addArticleAction()
    {
        $request = Request::createFromGlobals();

        try {
            if (!$request->request->has('name')) {
                throw new NoPostArgumentException(
                    'Аргумент "name" на задан в POST массиве'
                );
            }
            $name = htmlspecialchars($request->request->get('name'));

            if (empty($name)) {
                throw new EmptyParameterException(
                    'Статья должна иметь название'
                );
            }

            if (!$request->request->has('text')) {
                throw new NoPostArgumentException(
                    'Аргумент "text" на задан в POST массиве'
                );
            }
            $text = htmlspecialchars($request->request->get('text'));

            if (empty($text)) {
                throw new EmptyParameterException(
                    'Статья должна иметь текст'
                );
            }

            if (!$request->request->has('author')) {
                throw new NoPostArgumentException(
                    'Аргумент "author" на задан в POST массиве'
                );
            }
            $author = htmlspecialchars($request->request->get('author'));

            if (empty($author)) {
                throw new EmptyParameterException(
                    'Статья должна иметь автора'
                );
            }

            $name = null;
            $tmp = null;

            foreach ($request->files as $uploadedFile) {
                foreach ( $uploadedFile as $item) {
                    $name = $item->getClientOriginalName();
                    $item->move('img', $name);
                }
            }

            if ($name === null) {
                throw new EmptyParameterException(
                    'Картинка не выбрана'
                );
            }

            // Все хорошо, добавляем в базу!

            $preArticle['pathImage'] = 'img/' . $name;

            $article = new Article();
            $article->fromArray($preArticle);

            (new ArticleRepository())->insert($article);

        } catch (NoPostArgumentException $exception) {

            $response = new Response(
                'Content',
                Response::HTTP_OK,
                ['content-type' => 'text/html']
            );
            $jsonStr = json_encode(['NoPostArgumentException' => $exception->getMessage()]);
            $response->setContent($jsonStr);

            Log::getInstance()->addError(
                'Исключение в ArticleController->addArticleAction : ' . $exception->getMessage()
            );

            return $response;
        } catch(EmptyParameterException $exception) {

            $response = new Response(
                'Content',
                Response::HTTP_OK,
                ['content-type' => 'text/html']
            );
            $jsonStr = json_encode(['EmptyParameterException' => $exception->getMessage()]);
            $response->setContent($jsonStr);

            Log::getInstance()->addError(
                'Исключение в ArticleController->addArticleAction : ' . $exception->getMessage()
            );

            return $response;
        } catch (\Exception $exception) {

            $response = new Response(
                'Content',
                Response::HTTP_OK,
                ['content-type' => 'text/html']
            );
            $jsonStr = json_encode(['Exception' => $exception->getMessage()]);
            $response->setContent($jsonStr);

            Log::getInstance()->addError(
                'Исключение в ArticleController->addArticleAction : ' . $exception->getMessage()
            );

            return $response;
        }
    }

    /**
     * @param int $id
     */
    public function findAction($id)
    {
        Assert::assert($id, 'id')->notEmpty()->positive()->int();

        /**
         * todo: Этот action отображает существующие статьи и выводит заполненную форму, если такая сттья существует
         */

        try {

            $response = new Response(
                'Content',
                Response::HTTP_OK,
                ['content-type' => 'text/html']
            );
            $params = [
                //'article' => $article,
                //'errorAddArticle' => $errorAddArticle,
            ];
            $params['forContent'] = 'article.html';

            $response->setContent($this->renderByTwig('layoutFilled.html', $params));
            $response->send();
        } catch (\Exception $exception) {

        }
    }

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
}