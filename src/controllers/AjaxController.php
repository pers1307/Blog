<?php
/**
 * AjaxController.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\controllers;

use pers1307\blog\models;
use KoKoKo\assert\Assert;
use pers1307\blog\repository\ArticleRepository;

class AjaxController extends AbstractController
{
    /**
     * @param int $id
     *
     * @throws \InvalidArgumentException
     */
    public function deleteArticle($id)
    {
        try {
            Assert::assert($id, 'id')->match('/^\d+$/');
            Assert::assert($id, 'id')->lengthLess(3);
            $id = abs((int)$id);

            $articles = new ArticleRepository();
            $articles->deleteById($id);
        } catch (Exception $e) {
            echo 'ArticleNotDelete';
            return;
        }

        echo 'ArticleDelete';

        return;
    }
}