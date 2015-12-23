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
            $resultArray[] = $this->inflate($row);
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
            VALUES (:nameArticle, :auth, :textArticle, :img)'
        );
        $stmt->execute([
            'nameArticle' => $article->getName(),
            'auth' => $article->getAuthor(),
            'textArticle' => $article->getText(),
            'img' => $article->getPathImage()
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
     * @param int $limit
     * @param int $offset
     *
     * @return array
     * @throws \InvalidArgumentException
     */
    public function findByLimit($limit, $offset = 0)
    {
        Assert::assert($limit, 'limit')->notEmpty()->positive()->int();
        Assert::assert($offset, 'offset')->int();
        $forConnect = new db\MySqlConnection();
        $connection = $forConnect->getConnection();
        $stmt = $connection->prepare('SELECT * FROM articles LIMIT :offset, :limit');
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        $limitArticles = $stmt->fetchAll();
        $resultArray = [];

        foreach($limitArticles as $article) {
            $resultArray[] = $this->inflate($article);
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
        $stmt = $connection->prepare('SELECT * FROM articles WHERE id = :id');
        $stmt->bindParam('id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $found = $stmt->fetch();
        if (is_null($found)) {
            return null;
        }
        $resultArticle = $this->inflate($found);
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
    /**
     * @param array $articleRow
     *
     * @return Article
     * @throws \InvalidArgumentException
     */
    private function inflate(array $articleRow)
    {
        Assert::assert((int)$articleRow['id'], '$articleRow["id"]')->positive()->int();
        Assert::assert($articleRow['Date'], '$articleRow["Date"]')->notEmpty()->string();
        Assert::assert($articleRow['ArticleName'], '$articleRow["ArticleName"]')->notEmpty()->string();
        Assert::assert($articleRow['Author'], '$articleRow["Author"]')->notEmpty()->string();
        Assert::assert($articleRow['Article'], '$articleRow["Article"]')->notEmpty()->string();
        Assert::assert($articleRow['Image'], '$articleRow["Image"]')->notEmpty()->string();
        return (new Article())
            ->setId((int)$articleRow['id'])
            ->setCreatedAt($articleRow['Date'])
            ->setName($articleRow['ArticleName'])
            ->setAuthor($articleRow['Author'])
            ->setText($articleRow['Article'])
            ->setPathImage($articleRow['Image']);
    }
}