<?php
/**
 * User.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\models;
use KoKoKo\assert\Assert;

class User
{
    /** @var int */
    private $id;

    /** @var string */
    private $privileges;

    /** @var string */
    private $login;

    /** @var string */
    private $password;

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
     * @param string $privileges
     */
    public function setPrivileges($privileges)
    {
        Assert::assert($privileges, 'privileges')->notEmpty()->string();

        $this->privileges = $privileges;
    }

    /**
     * @return string
     */
    public function getPrivileges()
    {
        return $this->privileges;
    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        Assert::assert($login, 'login')->notEmpty()->string();

        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        Assert::assert($password, 'password')->notEmpty()->string();

        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}