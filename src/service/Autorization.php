<?php
/**
 * Autorization.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\service;

use KoKoKo\assert\Assert;
use pers1307\blog\repository\UserRepository;
use Symfony\Component\HttpFoundation\Session\Session;

class Autorization
{
    /** @var Autorization */
    private static $instance;

    /** @var Session */
    private static $session;

    private function __construct()
    {

    }

    private function __clone()
    {

    }

    public function starSession()
    {
        self::$session->start();
    }

    /**
     * @return Autorization
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
            self::newSession();
        }

        return self::$instance;
    }

    private static function newSession()
    {
        if (is_null(self::$session)) {
            self::$session = new Session();
        }
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

        self::$session->set('userId', $userId);
    }

    /**
     * @return UserRepository|null
     */
    public function getCurrentUserId()
    {
        return self::$session->get('userId');
    }

    public function exitSession()
    {
        self::$session->remove('userId');
    }

    /**
     * @return bool
     */
    public function checkAutorization()
    {
        if (self::$session->get('userId') === null) {
            return false;
        }

        return true;
    }
}