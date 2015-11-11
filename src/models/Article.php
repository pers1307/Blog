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
    private $name;

    /** @var string */
    private $createdAt;

    /** @var string */
    private $author;

    /** @var string */
    private $text;

    /** @var string */
    private $pathImage;

    /**
     * @param int $id
     *
     * @return Article
     * @throws \InvalidArgumentException
     */
    public function setId($id)
    {
        Assert::assert($id, 'id')->notEmpty()->int();

        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     *
     * @return Article
     * @throws \InvalidArgumentException
     */
    public function setName($name)
    {
        Assert::assert($name, 'name')->string();

        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $date
     *
     * @return Article
     * @throws \InvalidArgumentException
     */
    public function setCreatedAt($date)
    {
        Assert::assert($date, 'date')->notEmpty()->string();

        $this->createdAt = $date;

        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param string $author
     *
     * @return Article
     * @throws \InvalidArgumentException
     */
    public function setAuthor($author)
    {
        Assert::assert($author, 'author')->string();

        $this->author = $author;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $text
     *
     * @return Article
     * @throws \InvalidArgumentException
     */
    public function setText($text)
    {
        Assert::assert($text, 'text')->string();

        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $pathImage
     *
     * @return Article
     * @throws \InvalidArgumentException
     */
    public function setPathImage($pathImage)
    {
        Assert::assert($pathImage, 'pathImage')->notEmpty()->string();

        $this->pathImage = $pathImage;

        return $this;
    }

    /**
     * @return string
     */
    public function getPathImage()
    {
        return $this->pathImage;
    }
}