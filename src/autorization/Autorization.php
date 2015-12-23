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

use KoKoKo\assert\Assert;
use pers1307\blog\repository\UserRepository;

class Autorization
{
    /** @var Autorization */
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
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
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

        $users = new UserRepository();
        $user = $users->findByCreditionals($login);

        return !is_null($user); //&& \password_verify($password, $user->getPassword());
    }

    /**
     * @param int $userId
     *
     * @throws \InvalidArgumentException
     */
    public function setCurrentUserId($userId)
    {
        Assert::assert($userId, 'userId')->notEmpty()->int();
        $_SESSION['userId'] = $userId;
    }

    /**
     * @return UserRepository|null
     */
    public function getCurrentUser()
    {
        if (!isset($_SESSION['userId'])) {
            return null;
        }
        return $_SESSION['userId'];
    }

    public function exitSession()
    {
        if (isset($_SESSION['userId'])) {
            unset($_SESSION['userId']);
        }
    }

    /**
     * @return bool
     */
    public function checkAutorization()
    {
        return isset($_SESSION['userId']);
    }
}