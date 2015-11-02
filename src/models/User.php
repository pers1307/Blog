<?php
/**
 * User.php
 *
 * @category    UserModel
 * @package     Blog
 * @subpackage  Model
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @version     2.0
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\models;

class User
{
    private $id;
    private $privileges;
    private $login;
    private $password;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setPrivileges($privileges)
    {
        $this->privileges = $privileges;
    }

    public function getPrivileges()
    {
        return $this->privileges;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }
}