<?php
/**
 * UserRepository.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\repository;

use pers1307\blog\db;
use KoKoKo\assert\Assert;
use pers1307\blog\entity\User;

class UserRepository
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
            $resultArray[] = $this->setUserFromRowQuery($row);
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
        $stmt = $connection->prepare('
            SELECT *
            FROM users
            JOIN roles
            ON users.roleId = roles.id
            WHERE users.login = :login
        ');

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
     * @param int $id
     *
     * @return null
     * @throws \InvalidArgumentException
     */
    public function findLoginById($id)
    {
        Assert::assert($id, 'id')->notEmpty()->int();

        $connection = (new db\MySqlConnection())->getConnection();
        $stmt = $connection->prepare('SELECT login FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if ($row !== null) {
            $login = $row['Login'];
        } else {
            $login = null;
        }

        return $login;
    }

    /**
     * @param array $row
     *
     * @return User
     */
    protected function setUserFromRowQuery(array $row)
    {
        Assert::assert($row, 'row')->notEmpty()->isArray();

        $resultUser = (new User())
            ->setId((int)$row['id'])
            ->setLogin($row['login'])
            ->setRole($row['name'])
            ->setPassword($row['password']);

        return $resultUser;
    }
}