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
    private static $instance;

    private function __construct()
    {

    }

    private function __clone()
    {

    }

    public function starSession()
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
     *
     * @throw \InvalidArgumentException
     * @return bool
     */
    public function signIn($login, $password)
    {
        Assert::assert($login, 'login')->notEmpty()->string();
        Assert::assert($password, 'password')->notEmpty()->string();

        $users = new models\Users();
        $user = $users->findByCreditionals($login);

        if ($user !== null) {
            if (!\password_verify($password, $user->getPassword())) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * @return null|models\User
     */
    public function getCurrentUser()
    {
        if (isset($_SESSION['login'])) {
            $users = new models\Users();
            $user = $users->findByCreditionals($_SESSION['login']);
        } else {
            $user = null;
        }

        return $user;
    }

    public function exitSession() {

        if (isset($_SESSION['login'])) {
            unset($_SESSION['login']);
        }
    }

    /**
     * @return bool
     */
    public function checkAutorization() {

        return isset($_SESSION['login']);
    }

    /**
     * @param models\User $user
     *
     * @throw \InvalidArgumentException
     */
    public function setCurrentUser($user)
    {
        Assert::assert($user, 'user')->notEmpty()->string();

        $_SESSION['login'] = $user;
    }
}