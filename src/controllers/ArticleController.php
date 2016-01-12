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

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use pers1307\blog\repository\ArticleRepository;
use pers1307\blog\services\Autorization;
use pers1307\blog\repository\UserRepository;
use KoKoKo\assert\Assert;

class ArticleController extends AbstractController
{
    /**
     * todo: сюда переместить редактирование и добавление статьи
     */


    public function articleAction()
    {

    }


}