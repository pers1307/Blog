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

use pers1307\blog\repository\ArticleRepository;
use pers1307\blog\entity\Article;
use pers1307\blog\autorization\Autorization;
use KoKoKo\assert\Assert;

class ArticlesDeskController extends AbstractController
{
    /**
     * @return array
     * @throws \InvalidArgumentException
     */
    public function editArticleAction()
    {
        try {
            if (!Autorization::getInstance()->checkAutorization()) {
                $params = [
                    'forContent' => 'template/alertAutorization.html',
                    'message' => 'У вас нет доступа к этой странице. Пожалуйста, авторизируйтесь.'
                ];

                return $this->renderByTwig('layoutFilled.html', $params);
            }
            if (!isset($_GET['articleId'])) {
                $params = [
                    'forContent' => 'template/alertAutorization.html',
                    'message' => 'Такой статьи не существует.'
                ];

                return $this->renderByTwig('layoutFilled.html', $params);
            }


            $id = $_GET['articleId'];
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
            return $this->renderByTwig('layoutFilled.html', $params);
        } catch (\Exception $exception) {
            $params = [
                'forContent' => 'template/alertAutorization.html',
                'message' => $exception->getMessage()
            ];
            return $this->renderByTwig('layoutFilled.html', $params);
        }
    }

    public function findAllAction()
    {
        try {
            if (!Autorization::getInstance()->checkAutorization()) {
                throw new \Exception(
                    'У вас нет доступа к этой странице. Пожалуйста, авторизируйтесь.'
                );
            }
            $addResult = $this->addArticle();
            $article = new ArticleRepository();
            $articles = $article->findAll();
            $params = [
                'articles' => $articles,
                'addResult' => $addResult,
                'forContent' => 'articleDesk.html'
            ];
            return $this->renderByTwig('layoutFilled.html', $params);
        } catch (\Exception $exception) {
            $params = [
                'forContent' => 'template/alert.html',
                'message' => $exception->getMessage()
            ];
            return $this->renderByTwig('layoutFilled.html', $params);
        }
    }
    /**
     * @return Array
     * @throws \InvalidArgumentException|\Exception
     */
    protected function addArticle()
    {
        $preArticle = [];

        try {
            if (!isset($_POST['newArticleName'])) {
                throw new \InvalidArgumentException('Аргумент "newArticleName" на задан в POST массиве');
            }
            $preArticle['name'] = htmlspecialchars($_POST['newArticleName']);

            if (!isset($_POST['newArticleText'])) {
                throw new \InvalidArgumentException('Аргумент "newArticleText" на задан в POST массиве');
            }
            $preArticle['text'] = htmlspecialchars($_POST['newArticleText']);

            if (!isset($_POST['newArticleAuthor'])) {
                throw new \InvalidArgumentException('Аргумент "newArticleAuthor" на задан в POST массиве');
            }
            $preArticle['author'] = htmlspecialchars($_POST['newArticleAuthor']);

            if (!isset($_FILES['newArticleImage'])) {
                throw new \InvalidArgumentException('Аргумент "newArticleImage" на задан в POST массиве');
            }
            if ($_FILES['newArticleImage']['name']['0'] === '') {
                throw new \Exception(
                    'Картинка не выбрана!'
                );
            }
            if ($_FILES['newArticleImage']['error']['0'] !== 0) {
                throw new \Exception(
                    'Ошибка при загрузке картинки'
                );
            }
            $preArticle['pathImage'] = 'img/' . $_FILES['newArticleImage']['name']['0'];


            $article = new Article();
            $article->fromArray($preArticle);
            copy($_FILES['newArticleImage']['tmp_name']['0'], 'img/' . $_FILES['newArticleImage']['name']['0']);

            // Не переработано
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