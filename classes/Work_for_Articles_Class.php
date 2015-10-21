<?php

namespace Pereskokov;

class Work_for_Articles_Class
{
    public $count;
    private $res;

    public function GetAllArticlesFromDB()
    {
        $mysqli = new \mysqli("localhost","pers","13071992","myblog");
        $this->res = $mysqli->query("SELECT * FROM articles");
        $this->count = $this->res->num_rows;
        $mysqli->close();
    }

    public function GetNextArticle()
    {
        return $this->res->fetch_assoc();
    }
    public function AddNewArticle($NameTop,$TextText)
    {
        $mysqli = new \mysqli("localhost","pers","13071992","myblog");
        $mysqli->query("INSERT INTO articles(ArticleName,Article) VALUES ('$NameTop','$TextText')");
        $mysqli->close();
    }
    public function DeleteArticle($IdArticle)
    {
        $mysqli = new \mysqli("localhost","pers","13071992","myblog");
        $mysqli->query("DELETE FROM articles WHERE id = '$IdArticle'");
        $mysqli->close();
    }
}


