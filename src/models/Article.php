<?php
/**
 * Article.php
 *
 * @category    ArticleModel
 * @package     Blog
 * @subpackage  Model
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @version     2.0
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\models;

class Article
{
    private $id;
    private $nameArticle;
    private $date;
    private $author;
    private $textArticle;
    private $pathImage;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNameArticle($nameArticle)
    {
        $this->nameArticle = $nameArticle;
    }

    public function getNameArticle()
    {
        return $this->nameArticle;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setTextArticle($textArticle)
    {
        $this->textArticle = $textArticle;
    }

    public function getTextArticle()
    {
        return $this->textArticle;
    }

    public function setPathImage($pathImage)
    {
        $this->pathImage = $pathImage;
    }

    public function getPathImage()
    {
        return $this->pathImage;
    }
}