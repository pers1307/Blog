<?php
/**
 * ArticleRepository.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\repository;

use pers1307\blog\db;
use KoKoKo\assert\Assert;
use pers1307\blog\entity\Article;


class ArticleRepository
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
            $resultArray[] = (new Article())
                ->setId((int)$row['id'])
                ->setCreatedAt($row['Date'])
                ->setName($row['ArticleName'])
                ->setAuthor($row['Author'])
                ->setText($row['Article'])
                ->setPathImage($row['Image']);
        }

        return $resultArray;
    }

    /**
     * @param article $article
     *
     * @throws \InvalidArgumentException
     */
    public function insert(article $article)
    {
        Assert::assert($article->getName(), 'article->getName()')->notEmpty()->string();
        Assert::assert($article->getText(), 'article->getText()')->notEmpty()->string();
        Assert::assert($article->getAuthor(), 'article->getAuthor()')->notEmpty()->string();
        Assert::assert($article->getPathImage(), 'article->getPathImage()')->notEmpty()->string();

        $connection = (new db\MySqlConnection())->getConnection();
        $stmt = $connection->prepare(
            'INSERT INTO articles(ArticleName, Author, Article, Image)
            VALUES (:NameArticle, :Auth, :TextArticle, :Img)'
        );
        $stmt->execute([
            'NameArticle' => $article->getName(),
            'Auth' => $article->getAuthor(),
            'TextArticle' => $article->getText(),
            'Img' => $article->getPathImage()
        ]);
    }

    /**
     * @param int $id
     *
     * @throws \InvalidArgumentException
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

        $forConnect = new db\MySqlConnection();
        $connection = $forConnect->getConnection();
        $stmt = $connection->query('SELECT * FROM articles LIMIT ' . $offset . ', ' . $rowCount);
        $limitArticles = $stmt->fetchAll();

        $resultArray = [];
        foreach($limitArticles as $article) {
            $resultArray[] = (new Article())
                ->setId((int)$article['id'])
                ->setCreatedAt($article['Date'])
                ->setName($article['ArticleName'])
                ->setAuthor($article['Author'])
                ->setText($article['Article'])
                ->setPathImage($article['Image']);
        }

        return $resultArray;
    }

    /**
     * @return int
     */
    public function count()
    {
        $forConnect = new db\MySqlConnection();
        $connection = $forConnect->getConnection();
        $stmt = $connection->query(
            'SELECT COUNT(*) AS result
            FROM articles'
        );
        $result = $stmt->fetch();
        $result = $result['result'];

        return $result;
    }

    /**
     * @param int $id
     *
     * @return Article
     * @throws \InvalidArgumentException
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
                ->setCreatedAt($article['Date'])
                ->setName($article['ArticleName'])
                ->setAuthor($article['Author'])
                ->setText($article['Article'])
                ->setPathImage($article['Image']);
        } else {
            $resultArticle = null;
        }

        return $resultArticle;
    }

    /**
     * @param article $article
     */
    public function updateById(article $article)
    {
        $ForConnect = new db\MySqlConnection();
        $connection = $ForConnect->getConnection();
        $stmt = $connection->prepare(
            'UPDATE articles
            SET ArticleName = :articleName,
            Author = :author,
            Article = :text,
            Image = :img
            WHERE
            id = :id'
        );

        $stmt->execute([
            'id' => $article->getId(),
            'articleName' => $article->getName(),
            'author' => $article->getAuthor(),
            'text' => $article->getText(),
            'img' => $article->getPathImage()
        ]);
    }
}