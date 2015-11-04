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
     * @return \SplMinHeap
     */
    public function findAll()
    {
        $connection = (new db\MySqlConnection())->getConnection();
        $sql = 'SELECT * FROM users';
        $resultArray = new \SplMinHeap();

        foreach ($connection->query($sql) as $row) {
            $user = new User();
            $user->setId((int)$row['id']);
            $user->getLogin((string)$row['Login']);
            $user->setPrivileges((string)$row['Privileges']);
            $user->setPassword((string)$row['Password']);
        }

        return $resultArray;
    }

    /**
     * @param string $login
     * @param string $password
     *
     * @return User
     */
    public function findByCreditionals($login, $password = '')
    {
        Assert::assert($login, 'login')->notEmpty()->string();
        Assert::assert($password, 'password')->string();

        $connection = (new db\MySqlConnection())->getConnection();
        $stmt = $connection->prepare('SELECT * FROM users WHERE Login = :login');
        $stmt->execute(['login' => $login]);

        $resultUser = new User();

        if ($row = $stmt->fetch()) {
            $resultUser->setId((int)$row['id']);
            $resultUser->setLogin((string)$row['Login']);
            $resultUser->setPrivileges((string)$row['Privileges']);
            $resultUser->setPassword((string)$row['Password']);

            if ($password !== '') {
                if (!password_verify($password, $resultUser->getPassword())) {
                    echo 'Облом!';
                    $resultUser->setId(-1);
                    $resultUser->setLogin('-1');
                    $resultUser->setPrivileges('-1');
                    $resultUser->setPassword('-1');
                } else {
                    // Обрати внимание на эту строку, у меня получилось, что в базе пароль хэшированный лежит
                    // а по программе он бродит в не хэшированном виде. Я незнаю ок это или нет.
                    $resultUser->setPassword((string)$password);
                }
            }
        } else {
            $resultUser->setId(-1);
            $resultUser->setLogin('-1');
            $resultUser->setPrivileges('-1');
            $resultUser->setPassword('-1');
        }

        return $resultUser;
    }
}