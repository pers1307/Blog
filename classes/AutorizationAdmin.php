<?php

//namespace Pereskokov;

class AutorizationAdmin
{
    private $login;
    private $password;

    public function __construct()
    {
        $mysqli = new \mysqli("localhost", "pers","13071992","myblog");

        $res = $mysqli->query("SELECT * FROM users");

        for($count = 0;$count < $res->num_rows; $count++) {
            $arrRez = $res->fetch_assoc();
            $this->login = $arrRez['Login'];
            $this->password = $arrRez['Password'];
        }
        $mysqli->close();
    }

    public function CheckAdministrator($login,$password)
    {
        if($this->login == $login && $this->password == $password)
            return true;
        else
            return false;
    }
}
