<?php
/**
 * User.php
 *
 * @category    ArticleModel
 * @package     Blog
 * @subpackage  Model
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     MyLicence
 * @version     1.0
 * @link        https://github.com/pers1307/Blog
 */

namespace pers1307\blog\models;

use pers1307\blog\db;

require_once 'src/db/MySqlConnection.php';

class Article
{
    public function findAll()
    {
        $ForConnect = new db\MySqlConnection();
        $connection = $ForConnect->getConnection();
        $stmt = $connection->query('SELECT * FROM articles');
        $count = 0;
        while ($row = $stmt->fetch()) {
            $resultArray[$count] = array(
                                            'id' => $row['id'],
                                            'Date' => $row['Date'],
                                            'ArticleName' => $row['ArticleName'],
                                            'ArticleText' => $row['Article']
            );
            $count++;
        }
        $ForConnect->close();
        return $resultArray;
    }

    public function insert($newArticleName, $newArticleText)
    {
        $ForConnect = new db\MySqlConnection();
        $connection = $ForConnect->getConnection();
        $stmt = $connection->prepare('INSERT INTO articles(ArticleName,Article) VALUES (:NameArticle,:TextArticle)');
        $stmt->execute(array('NameArticle' => $newArticleName, 'TextArticle' => $newArticleText));
        $ForConnect->close();
    }

    public function deleteByid($id)
    {
        $ForConnect = new db\MySqlConnection();
        $connection = $ForConnect->getConnection();
        $stmt = $connection->prepare('DELETE FROM articles WHERE id = :id');
        $stmt->execute(array('id' => $id));
        $ForConnect->close();
    }
}