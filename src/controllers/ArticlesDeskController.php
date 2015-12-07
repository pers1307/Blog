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
        // Ром, у меня здесь затруднение есть: я раньше помещал данные в entity article до проверки, чтобы
        // потом у меня данные на форме не потерялись после отправки. То есть я отправляю POST запрос
        // данные на форме сбрасываются, потом они после обновления страницы, должны встать обратно в форму, чтобы
        // юзер не забивал всю форму заново.
        // Я не знаю как по правильному это сделать. Может вместо entity простой массив заполнять?
        if (isset($_POST['NewArticleName']) && isset($_POST['NewArticleText']) && isset($_POST['NewArticleAuthor'])) {
            try {

                if (!isset($_POST['NewArticleName'])) {
                    throw new \InvalidArgumentException('Аргумент "NewArticleName" на задан в POST массиве');
                }

                if ($_POST['NewArticleName'] === '') {
                    throw new \Exception(
                        'Название статьи не может быть пустым!'
                    );
                }

                if (!isset($_POST['NewArticleText'])) {
                    throw new \InvalidArgumentException('Аргумент "NewArticleText" на задан в POST массиве');
                }

                if ($_POST['NewArticleText'] === '') {
                    throw new \Exception(
                        'Текст статьи не может быть пустым!'
                    );
                }

                if (!isset($_POST['NewArticleAuthor'])) {
                    throw new \InvalidArgumentException('Аргумент "NewArticleAuthor" на задан в POST массиве');
                }

                if ($_POST['NewArticleAuthor'] === '') {
                    throw new \Exception(
                        'Статья не может быть без автора!'
                    );
                }

                if (!isset($_FILES['NewArticleImage'])) {
                    throw new \InvalidArgumentException('Аргумент "NewArticleImage" на задан в POST массиве');
                }

                if ($_FILES['NewArticleImage']['name']['0'] === '') {
                    throw new \Exception(
                        'Картинка не выбрана!'
                    );
                }

                if ($_FILES['NewArticleImage']['error']['0'] !== 0) {
                    throw new \Exception(
                        'Ошибка при загрузке картинки'
                    );
                }

                $article = (new Article())
                    ->setName(htmlspecialchars($_POST['NewArticleName']))
                    ->setAuthor(htmlspecialchars($_POST['NewArticleAuthor']))
                    ->setText(htmlspecialchars($_POST['NewArticleText']))
                    ->setPathImage('img/' . $_FILES['NewArticleImage']['name']['0']);

                copy($_FILES['NewArticleImage']['tmp_name']['0'], 'img/' . $_FILES['NewArticleImage']['name']['0']);

                (new ArticleRepository())->insert($article);
            } catch (\Exception $exception) {
                return [
                    'TextError' => $exception->getMessage(),
                    'article' => $article
                ];
            }
        }

        return [
            'TextError' => '',
            'article' => null
        ];
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