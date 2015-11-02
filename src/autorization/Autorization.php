<?php
/**
 * Autorization.php
 *
 * @category    Autorization
 * @package     Blog
 * @subpackage  Autorization
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @version     2.0
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\autorization;

use pers1307\blog\models;

require_once 'src/models/Users.php';

class Autorization
{
    protected static $instance;

    private function __construct() {}

    private function __clone() {}

    protected function starSession()
    {
        session_start();
    }

    public static function getInstance()
    {
        return (self::$instance === null) ? self::$instance = new self() : self::$instance;
    }

    public function authentication($login, $password)
    {
        $users = new models\Users();
        $user = $users->findByCreditionals($login, $password);

        if ($login === $user->getLogin() && $password === $user->getPassword() && $user->getPrivileges() === 'admin') {

            return true;
        } else {
            return false;
        }
    }

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

    public function exitSession() {
        $this->starSession();

        if (isset($_SESSION['User'])) {
            unset($_SESSION['User']);
        }
    }

    public function checkAutorization() {
        $this->starSession();

        if (isset($_SESSION['User'])) {
            return true;
        } else {
            return false;
        }
    }

    public function setCurrentUser($user)
    {
        $this->starSession();
        $_SESSION['User'] = $user;
    }
}