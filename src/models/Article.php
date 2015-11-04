<?php
/**
 * Article.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\models;
use KoKoKo\assert\Assert;

class Article
{
    /** @var int */
    private $id;

    /** @var string */
    private $nameArticle;

    /** @var string */
    private $date;

    /** @var string */
    private $author;

    /** @var string */
    private $textArticle;

    /** @var string */
    private $pathImage;

    /**
     * @param int $id
     */
    public function setId($id)
    {
        Assert::assert($id, 'id')->notEmpty()->int();

        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $nameArticle
     */
    public function setNameArticle($nameArticle)
    {
        Assert::assert($nameArticle, 'nameArticle')->notEmpty()->string();

        $this->nameArticle = $nameArticle;
    }

    /**
     * @return string
     */
    public function getNameArticle()
    {
        return $this->nameArticle;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        Assert::assert($date, 'date')->notEmpty()->string();

        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $author
     */
    public function setAuthor($author)
    {
        Assert::assert($author, 'author')->notEmpty()->string();

        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $textArticle
     */
    public function setTextArticle($textArticle)
    {
        Assert::assert($textArticle, 'textArticle')->notEmpty()->string();

        $this->textArticle = $textArticle;
    }

    /**
     * @return string
     */
    public function getTextArticle()
    {
        return $this->textArticle;
    }

    /**
     * @param string $pathImage
     */
    public function setPathImage($pathImage)
    {
        Assert::assert($pathImage, 'pathImage')->notEmpty()->string();

        $this->pathImage = $pathImage;
    }

    /**
     * @return string
     */
    public function getPathImage()
    {
        return $this->pathImage;
    }
}