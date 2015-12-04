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

use pers1307\blog\autorization\Autorization;
use KoKoKo\assert\Assert;
use pers1307\blog\repository\ArticleRepository;
use pers1307\blog\entity\Article;

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
                throw new \Exception(
                    "У вас нет доступа к этой странице. Пожалуйста, авторизируйтесь."
                );
            }

            if (!isset($_GET['articleId'])) {
                throw new \Exception(
                    "Такой статьи не существует."
                );
            }

            $id = (int)htmlspecialchars($_GET['articleId']);
            $id = Assert::assert($id, 'id')->notEmpty()->positive()->int()->get();

            $modelArticle = new ArticleRepository();
            $article = $modelArticle->findById($id);

            if ($article === null) {
                throw new \Exception(
                    "Такой статьи не существует."
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
                'forContent' => 'template/alert.html',
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
                    "У вас нет доступа к этой странице. Пожалуйста, авторизируйтесь."
                );
            }

            $errorAddArticle = $this->addArticle();

            $article = new ArticleRepository();
            $articles = $article->findAll();

            $params = [
                'articles' => $articles,
                'errorAddArticle' => $errorAddArticle,
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
     */
    protected function addArticle()
    {
        /*
        try {
            if (!isset($_POST['name'])) {
                throw new \InvalidArgumentException('Argument "name" is requred');
            }


        } catch (\Exception $exception) {

        }
        */

        if (isset($_POST['NewArticleName']) && isset($_POST['NewArticleText']) && isset($_POST['NewArticleAuthor'])) {

            $article = (new Article())
                ->setName($_POST['NewArticleName'])
                ->setAuthor($_POST['NewArticleAuthor'])
                ->setText($_POST['NewArticleText']);

            if (isset($_FILES['NewArticleImage'])) {
                $article->setPathImage('img/' . $_FILES['NewArticleImage']['name']['0']);
            }

            if ($_POST['NewArticleName'] === '') {
                return $this->setErrors('1', 'Название статьи не может быть пустым!', $article);
            }
            if ($_POST['NewArticleAuthor'] === '') {
                return $this->setErrors('2', 'Статья не может быть без автора!', $article);
            }
            if (isset($_FILES['NewArticleImage'])) {
                if ($_FILES['NewArticleImage']['name']['0'] === '') {
                    return $this->setErrors('3', 'Картинка не выбрана!', $article);
                }
                if ($_FILES['NewArticleImage']['error']['0'] !== 0) {
                    return $this->setErrors('3', 'Ошибка при загрузке картинки', $article);
                }
            } else {
                return $this->setErrors('3', 'Картинка не выбрана!', $article);
            }
            if ($_POST['NewArticleText'] === '') {
                return $this->setErrors('4', 'Текст статьи не может быть пустым!', $article);
            }

            $articles = new ArticleRepository();
            copy($_FILES['NewArticleImage']['tmp_name']['0'], 'img/' . $_FILES['NewArticleImage']['name']['0']);

            $article->setPathImage('img/' . $_FILES['NewArticleImage']['name']['0']);
            $articles->insert($article);
            unset($_POST['NewArticleName'], $_POST['NewArticleText'], $_POST['NewArticleAuthor'], $_POST['NewArticleImage']);

            return $this->setErrors('0', '', null);
        } else {
            unset($_POST['NewArticleName'], $_POST['NewArticleText'], $_POST['NewArticleAuthor'], $_POST['NewArticleImage']);

            return $this->setErrors('0', '', null);
        }
    }

    /**
     * @param Article $article
     *
     * @return Array
     */
    protected function editArticle(Article $article)
    {
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
     * @param string code
     * @param string $text
     * @param null|ArticleRepository $article
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