<?php
/**
 * Articles.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\models;

use pers1307\blog\db;
use KoKoKo\assert\Assert;

class Articles
{
    /**
     * @return \SplMinHeap
     */
    public function findAll()
    {
        $connection = (new db\MySqlConnection())->getConnection();
        $sql = 'SELECT * FROM articles';
        $resultArray = new \SplMinHeap();

        foreach ($connection->query($sql) as $row) {
            $article = new Article();
            $article->setId((int)$row['id']);
            $article->setDate((string)$row['Date']);
            $article->setNameArticle((string)$row['ArticleName']);
            $article->setAuthor((string)$row['Author']);
            $article->setTextArticle((string)$row['Article']);
            $article->setPathImage((string)$row['Image']);
            $resultArray->insert($article);
        }

        return $resultArray;
    }

    /**
     * @param string $newArticleName
     * @param string $newArticleText
     * @param string $newArticleAuthor
     * @param string $NewArticleImage
     */
    public function insert($newArticleName, $newArticleText, $newArticleAuthor, $NewArticleImage)
    {
        Assert::assert($newArticleName, 'newArticleName')->notEmpty()->string();
        Assert::assert($newArticleText, 'newArticleText')->notEmpty()->string();
        Assert::assert($newArticleAuthor, 'newArticleAuthor')->notEmpty()->string();
        Assert::assert($NewArticleImage, 'NewArticleImage')->notEmpty()->string();

        $connection = (new db\MySqlConnection())->getConnection();
        $stmt = $connection->prepare('INSERT INTO articles(ArticleName, Author, Article, Image) VALUES (:NameArticle, :Auth, :TextArticle, :Img)');
        $stmt->execute(['NameArticle' => $newArticleName, 'Auth' => $newArticleAuthor,'TextArticle' => $newArticleText, 'Img' => $NewArticleImage]);
    }

    /**
     * @param int $id
     */
    public function deleteByid($id)
    {
        Assert::assert($id, 'id')->notEmpty()->int();

        $connection = (new db\MySqlConnection())->getConnection();
        $stmt = $connection->prepare('DELETE FROM articles WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
}