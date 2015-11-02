<?php
/**
 * Users.php
 *
 * @category    UsersModel
 * @package     Blog
 * @subpackage  Model
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @version     2.0
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\models;

use pers1307\blog\db;

require_once 'src/db/MySqlConnection.php';
require_once 'src/models/User.php';

class Users
{
    public function findAll()
    {
        $ForConnect = new db\MySqlConnection();
        $connection = $ForConnect->getConnection();
        $stmt = $connection->query('SELECT * FROM users');
        $resultArray = new \SplMinHeap();

        while ($row = $stmt->fetch()) {
            $user = new User();
            $user->setId($row['id']);
            $user->getLogin($row['Login']);
            $user->setPrivileges($row['Privileges']);
            $user->setPassword($row['Password']);
        }

        return $resultArray;
    }

    public function findByCreditionals($login, $password = '')
    {
        $ForConnect = new db\MySqlConnection();
        $connection = $ForConnect->getConnection();
        if ($password === '') {
            $stmt = $connection->prepare('SELECT * FROM users WHERE Login = :login');
            $stmt->execute(['login' => $login]);
        } else {
            $stmt = $connection->prepare('SELECT * FROM users WHERE Login = :login AND Password = :password');
            $stmt->execute(['login' => $login, 'password' => $password]);
        }

        $resultUser = new User();

        if ($row = $stmt->fetch()) {
            $resultUser->setId($row['id']);
            $resultUser->setLogin($row['Login']);
            $resultUser->setPrivileges($row['Privileges']);
            $resultUser->setPassword($row['Password']);
        } else {
            $resultUser->setId(-1);
            $resultUser->setLogin('');
            $resultUser->setPrivileges('');
            $resultUser->setPassword('');
        }

        return $resultUser;
    }
}