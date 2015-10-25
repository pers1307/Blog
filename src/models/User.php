<?php
/**
 * User.php
 *
 * @category    UserModel
 * @package     Blog
 * @subpackage  Model
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     MyLicence
 * @version     1.0
 * @link        https://github.com/pers1307/Blog
 */

namespace pers1307\blog\models;

use pers1307\blog\db;

require_once 'src/db/MySqlConnection.php';

class User
{
    public function findAll()
    {
        $ForConnect = new db\MySqlConnection();
        $connection = $ForConnect->getConnection();
        $stmt = $connection->query('SELECT * FROM users');
        $count = 0;
        while ($row = $stmt->fetch()) {
            $resultArray[$count] = array (
                'id' => $row['id'],
                'Login' => $row['Login'],
                'Password' => $row['Password'],
            );
            $count++;
        }
        $ForConnect->close();
        return $resultArray;
    }

    public function findByCreditionals($login, $password)
    {
        $ForConnect = new db\MySqlConnection();
        $connection = $ForConnect->getConnection();
        $stmt = $connection->query('SELECT * FROM users');
        while ($row = $stmt->fetch()) {
            if ($row['Login'] == $login && $row['Password'] == $password) {
                $ForConnect->close();
                return true;
            }
        }
        $ForConnect->close();
        return false;
    }


}



