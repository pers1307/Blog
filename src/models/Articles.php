<?php
/**
 * Articles.php
 *
 * @category    ArticlesModel
 * @package     Blog
 * @subpackage  Model
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @version     2.0
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\models;

use pers1307\blog\db;

require_once 'src/db/MySqlConnection.php';
require_once 'src/models/Article.php';

class Articles
{
    public function findAll()
    {
        $ForConnect = new db\MySqlConnection();
        $connection = $ForConnect->getConnection();
        $stmt = $connection->query('SELECT * FROM articles');
        $resultArray = new \SplMinHeap();

        while ($row = $stmt->fetch()) {
            $article = new Article();
            $article->setId($row['id']);
            $article->setDate($row['Date']);
            $article->setNameArticle($row['ArticleName']);
            $article->setAuthor($row['Author']);
            $article->setTextArticle($row['Article']);
            $article->setPathImage($row['Image']);
            $resultArray->insert($article);
        }

        return $resultArray;
    }

    public function insert($newArticleName, $newArticleText, $newArticleAuthor, $NewArticleImage)
    {
        $ForConnect = new db\MySqlConnection();
        $connection = $ForConnect->getConnection();
        $stmt = $connection->prepare('INSERT INTO articles(ArticleName, Author, Article, Image) VALUES (:NameArticle, :Auth, :TextArticle, :Img)');
        $stmt->execute(['NameArticle' => $newArticleName, 'Auth' => $newArticleAuthor,'TextArticle' => $newArticleText, 'Img' => $NewArticleImage]);
    }

    public function deleteByid($id)
    {
        $ForConnect = new db\MySqlConnection();
        $connection = $ForConnect->getConnection();
        $stmt = $connection->prepare('DELETE FROM articles WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
}