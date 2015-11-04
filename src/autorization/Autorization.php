<?php
/**
 * Autorization.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\autorization;

use pers1307\blog\models;
use KoKoKo\assert\Assert;

class Autorization
{
    /**
     * @var Autorization
     */
    protected static $instance;

    /**
     *
     */
    private function __construct() {}

    /**
     *
     */
    private function __clone() {}

    /**
     *
     */
    protected function starSession()
    {
        session_start();
    }

    /**
     * @return Autorization
     */
    public static function getInstance()
    {
        return (self::$instance === null) ? self::$instance = new self() : self::$instance;
    }

    /**
     * @param string $login
     * @param string $password
     * @return bool
     */
    public function authentication($login, $password)
    {
        Assert::assert($login, 'login')->string();
        Assert::assert($password, 'password')->string();

        $users = new models\Users();
        $user = $users->findByCreditionals($login, $password);

        if ($login === $user->getLogin() && $password === $user->getPassword() && $user->getPrivileges() === 'admin') {

            return true;
        } else {

            return false;
        }
    }

    /**
     * @return models\User
     */
    public function getCurrentUser()
    {
        $this->starSession();

        if (isset($_SESSION['User'])) {
            $users = new models\Users();
            $user = $users->findByCreditionals($_SESSION['User']);
        } else {
            $user = new User();
            $user->setId(-1);
            $user->setLogin('');
            $user->setPrivileges('');
            $user->setPassword('');
        }

        return $user;
    }

    /**
     *
     */
    public function exitSession() {
        $this->starSession();

        if (isset($_SESSION['User'])) {
            unset($_SESSION['User']);
        }
    }

    /**
     * @return bool
     */
    public function checkAutorization() {
        $this->starSession();

        if (isset($_SESSION['User'])) {

            return true;
        } else {

            return false;
        }
    }

    /**
     * @param models\User $user
     */
    public function setCurrentUser($user)
    {
        Assert::assert($user, 'user')->notEmpty()->string();

        $this->starSession();
        $_SESSION['User'] = $user;
    }
}