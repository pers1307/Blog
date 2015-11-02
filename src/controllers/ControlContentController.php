<?php
/**
 * controlContentController.php
 *
 * @category    ControlContentController
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

class ControlContentController extends Controller
{
    public function controlContent()
    {
        $status = $this->checkAutorization();
        $errorAddArticle = $this->addArticle();
        $this->deleteArticle();

        $article = new models\Articles();
        $articles = $article->findAll();

        $params['content'] = 'views/contentControlContentPage.php';
        $params['status'] = $status;
        $params['articles'] = $articles;
        $params['errorAddArticle'] = $errorAddArticle;

        echo $this->render('views/general.php', $params);
    }

    protected function checkAutorization()
    {
        if (autorization\Autorization::getInstance()->checkAutorization()) {
            return 'Accept';
        } else {
            return 'Unaccept';
        }
    }

    protected function deleteArticle()
    {
        if (isset($_GET['Delete'])) {
            $article = new models\Articles();
            $article->deleteByid(abs((int)$_GET['Delete']));
            unset($_GET['Delete']);
        }
    }

    protected function addArticle()
    {
        if (isset($_POST['NewArticleName']) && isset($_POST['NewArticleText']) && isset($_POST['NewArticleAuthor'])) {

            if ($_POST['NewArticleName'] === '') {
                return $this->setErrors('1', 'Название статьи не может быть пустым!');
            }
            if ($_POST['NewArticleAuthor'] === '') {
                return $this->setErrors('2', 'Статья не может быть без автора!');
            }
            if (isset($_FILES['NewArticleImage'])) {
                if ($_FILES['NewArticleImage']['name']['0'] === '') {
                    return $this->setErrors('3', 'Картинка не выбрана!');
                }
                if ($_FILES['NewArticleImage']['error']['0'] !== 0) {
                    return $this->setErrors('3', 'Ошибка при загрузке картинки');
                }
            } else {
                return $this->setErrors('3', 'Картинка не выбрана!');
            }

            if ($_POST['NewArticleText'] === '') {
                return $this->setErrors('4', 'Текст статьи не может быть пустым!');
            }

            $article = new models\Articles();
            copy($_FILES['NewArticleImage']['tmp_name']['0'], 'img/' . $_FILES['NewArticleImage']['name']['0']);
            $article->insert($_POST['NewArticleName'], $_POST['NewArticleText'], $_POST['NewArticleAuthor'], 'img/'.$_FILES['NewArticleImage']['name']['0']);
            unset($_POST['NewArticleName'], $_POST['NewArticleText'], $_POST['NewArticleAuthor'], $_POST['NewArticleImage']);
            return $this->setErrors('0', '');
        } else {
            unset($_POST['NewArticleName'], $_POST['NewArticleText'], $_POST['NewArticleAuthor'], $_POST['NewArticleImage']);
            return $this->setErrors('0', '');
        }
    }

    protected function setErrors($code, $text)
    {
        $errors['TextError'] = $text;
        $errors['CodeError'] = $code;

        return $errors;
    }
}