<?php
/**
 * User.php
 *
 * @category    MySqlConnectionDb
 * @package     Blog
 * @subpackage  Db
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     MyLicence
 * @version     1.0
 * @link        https://github.com/pers1307/Blog
 */

namespace pers1307\blog\db;

require_once 'src/db/ConstantList.php';

class MySqlConnection
{
    private static $connection;

    public function getConnection()
    {
        if (self::$connection == null) {
            $this->createConnectFromConst();
        }
        return self::$connection;
    }

    public function close()
    {
        if (self::$connection != null) {
            self::$connection = null;
        }
    }

    protected function createConnectFromConst()
    {
        if (HOST != null && USER != null && PASSWORD != null && DBNAME != null) {
            $dsn = 'mysql:host=' . HOST . ';dbname=' . DBNAME;
            $opt = array(
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            );
            $pdo = new \PDO($dsn, USER, PASSWORD, $opt);
            self::$connection = $pdo;
        } else {
            throw new \Exception('Not exist define parametrs.');
        }

    }
}

