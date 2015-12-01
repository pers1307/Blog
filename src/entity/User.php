<?php
/**
 * User.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\entity;

use KoKoKo\assert\Assert;

class User
{
    /** @var int */
    private $id;

    /** @var string */
    private $role;

    /** @var string */
    private $login;

    /** @var string */
    private $password;

    /**
     * @param int $id
     *
     * @return User
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
     * @param string $role
     *
     * @return User
     * @throws \InvalidArgumentException
     */
    public function setRole($role)
    {
        Assert::assert($role, 'role')->notEmpty()->string();

        $this->role = $role;

        return $this;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $login
     *
     * @return User
     * @throws \InvalidArgumentException
     */
    public function setLogin($login)
    {
        Assert::assert($login, 'login')->notEmpty()->string();

        $this->login = $login;

        return $this;
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
     *
     * @return User
     * @throws \InvalidArgumentException
     */
    public function setPassword($password)
    {
        Assert::assert($password, 'password')->notEmpty()->string();

        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}