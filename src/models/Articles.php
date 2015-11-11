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
     * @return Array
     */
    public function findAll()
    {
        $connection = (new db\MySqlConnection())->getConnection();
        $sql = 'SELECT * FROM articles';
        $sth = $connection->prepare($sql);
        $sth->execute();
        $allArticles = $sth->fetchAll();

        $resultArray = [];
        foreach ($allArticles as $row) {
            $article = (new Article())
                ->setId((int)$row['id'])
                ->setCreatedAt((string)$row['Date'])
                ->setName((string)$row['ArticleName'])
                ->setAuthor((string)$row['Author'])
                ->setText((string)$row['Article'])
                ->setPathImage((string)$row['Image']);
            $resultArray[] = $article;
        }

        return $resultArray;
    }

    /**
     * @param Article $article
     *
     * @throws \InvalidArgumentException
     */
    public function insert(Article $article)
    {
        Assert::assert($article->getName(), 'article->getName()')->notEmpty()->string();
        Assert::assert($article->getText(), 'article->getText()')->notEmpty()->string();
        Assert::assert($article->getAuthor(), 'article->getAuthor()')->notEmpty()->string();
        Assert::assert($article->getPathImage(), 'article->getPathImage()')->notEmpty()->string();

        $connection = (new db\MySqlConnection())->getConnection();
        $stmt = $connection->prepare('INSERT INTO articles(ArticleName, Author, Article, Image) VALUES (:NameArticle, :Auth, :TextArticle, :Img)');
        $stmt->execute(['NameArticle' => $article->getName(), 'Auth' => $article->getAuthor(),'TextArticle' => $article->getText(), 'Img' => $article->getPathImage()]);
    }

    /**
     * @param int $id
     */
    public function deleteById($id)
    {
        Assert::assert($id, 'id')->notEmpty()->int();

        $connection = (new db\MySqlConnection())->getConnection();
        $stmt = $connection->prepare('DELETE FROM articles WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    /**
     * @param int $rowCount
     * @param int $offset
     *
     * @return array
     * @throws \InvalidArgumentException
     */
    public function findByLimit($rowCount, $offset = 0)
    {
        Assert::assert($rowCount, 'rowCount')->notEmpty()->int();
        Assert::assert($offset, 'offset')->int();

        $ForConnect = new db\MySqlConnection();
        $connection = $ForConnect->getConnection();
        $stmt = $connection->query('SELECT * FROM articles LIMIT ' . $offset . ', ' . $rowCount);
        $limitArticles = $stmt->fetchAll();

        $resultArray = [];
        foreach($limitArticles as $article) {
            $resultArticle = (new Article())
                ->setId((int)$article['id'])
                ->setCreatedAt((string)$article['Date'])
                ->setName((string)$article['ArticleName'])
                ->setAuthor((string)$article['Author'])
                ->setText((string)$article['Article'])
                ->setPathImage((string)$article['Image']);
            $resultArray[] = $resultArticle;
        }

        return $resultArray;
    }

    /**
     * @return int
     */
    public function count()
    {
        $ForConnect = new db\MySqlConnection();
        $connection = $ForConnect->getConnection();
        $stmt = $connection->query('SELECT COUNT(*) FROM articles');
        $result = $stmt->fetch();
        $result = $result['COUNT(*)'];

        return $result;
    }

    /**
     * @param int $id
     * @return Article
     */
    public function findById($id)
    {
        Assert::assert($id, 'id')->notEmpty()->int();

        $ForConnect = new db\MySqlConnection();
        $connection = $ForConnect->getConnection();

        $stmt = $connection->query('SELECT * FROM articles WHERE id = ' . $id);
        $article = $stmt->fetch();

        if ($stmt->rowCount() !== 0) {
            $resultArticle = (new Article())
                ->setId((int)$article['id'])
                ->setCreatedAt((string)$article['Date'])
                ->setName((string)$article['ArticleName'])
                ->setAuthor((string)$article['Author'])
                ->setText((string)$article['Article'])
                ->setPathImage((string)$article['Image']);
        } else {
            $resultArticle = null;
        }

        return $resultArticle;
    }

    /**
     * @param Article $article
     */
    public function updateById(Article $article)
    {
        $ForConnect = new db\MySqlConnection();
        $connection = $ForConnect->getConnection();
        $stmt = $connection->prepare('UPDATE articles SET ArticleName = :articleName,
                                                          Author = :author,
                                                          Article = :text,
                                                          Image = :img
                                                          WHERE
                                                          id = :id');
        $stmt->execute(['id' => $article->getId(),
                        'articleName' => $article->getName(),
                        'author' => $article->getAuthor(),
                        'text' => $article->getText(),
                        'img' => $article->getPathImage()]);
    }

    /**
     * @param string $like
     *
     * @return array
     * @throws \InvalidArgumentException
     */
    public function likeInName($like)
    {
        Assert::assert($like, 'like')->notEmpty()->string();

        $connection = (new db\MySqlConnection())->getConnection();
        $sql = "SELECT * FROM articles WHERE LOWER( ArticleName ) LIKE '%" . $like . "%'";
        $sth = $connection->prepare($sql);
        $sth->execute();
        $allArticles = $sth->fetchAll();

        $resultArray = [];
        foreach ($allArticles as $row) {
            $article = (new Article())
                ->setId((int)$row['id'])
                ->setCreatedAt((string)$row['Date'])
                ->setName((string)$row['ArticleName'])
                ->setAuthor((string)$row['Author'])
                ->setText((string)$row['Article'])
                ->setPathImage((string)$row['Image']);
            $resultArray[] = $article;
        }

        return $resultArray;
    }

    /**
     * @param string $like
     *
     * @return array
     * @throws \InvalidArgumentException
     */
    public function likeInText($like)
    {
        Assert::assert($like, 'like')->notEmpty()->string();

        $connection = (new db\MySqlConnection())->getConnection();
        $sql = "SELECT * FROM articles WHERE LOWER( Article ) LIKE '%" . $like . "%'";
        $sth = $connection->prepare($sql);
        $sth->execute();
        $allArticles = $sth->fetchAll();

        $resultArray = [];
        foreach ($allArticles as $row) {
            $article = (new Article())
                ->setId((int)$row['id'])
                ->setCreatedAt((string)$row['Date'])
                ->setName((string)$row['ArticleName'])
                ->setAuthor((string)$row['Author'])
                ->setText((string)$row['Article'])
                ->setPathImage((string)$row['Image']);
            $resultArray[] = $article;
        }

        return $resultArray;

    }

}