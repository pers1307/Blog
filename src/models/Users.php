<?php
/**
 * Users.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\models;

use pers1307\blog\db;
use KoKoKo\assert\Assert;

class Users
{
    /**
     * @return Array
     */
    public function findAll()
    {
        $connection = (new db\MySqlConnection())->getConnection();
        $sql = 'SELECT * FROM users';
        $sth = $connection->prepare($sql);
        $sth->execute();
        $allUsers = $sth->fetchAll();

        $resultArray = [];
        foreach ($allUsers as $row) {
            $user = $this->setUserFromRowQuery($row);
            $resultArray[] = $user;
        }

        return $resultArray;
    }

    /**
     * @param string $login
     *
     * @return null|User
     * @throws \InvalidArgumentException
     */
    public function findByCreditionals($login)
    {
        Assert::assert($login, 'login')->notEmpty()->string();

        $connection = (new db\MySqlConnection())->getConnection();
        $stmt = $connection->prepare('SELECT * FROM users WHERE Login = :login');
        $stmt->execute(['login' => $login]);

        $row = $stmt->fetch();
        if ($row !== null) {
            $resultUser = $this->setUserFromRowQuery($row);
        } else {
            $resultUser = null;
        }

        return $resultUser;
    }

    /**
     * @param Array $row
     *
     * @return User
     */
    protected function setUserFromRowQuery($row)
    {
        $resultUser = (new User())
            ->setId((int)$row['id'])
            ->setLogin((string)$row['Login'])
            ->setRole((string)$row['Privileges'])
            ->setPassword((string)$row['Password']);

        return $resultUser;
    }
}