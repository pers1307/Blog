<?php
/**
 * MySqlConnection.php
 *
 * @category    MySqlConnectionDb
 * @package     Blog
 * @subpackage  Db
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @version     2.0
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\db;

require_once 'src/db/Config.php';

class MySqlConnection
{
    private static $connection;

    public function getConnection()
    {
        if (self::$connection === null) {
            $this->createConnectFromConst();
        }
        return self::$connection;
    }

    public function close()
    {
        if (self::$connection !== null) {
            self::$connection = null;
        }
    }

    protected function createConnectFromConst()
    {
        $config = new Config();

        $opt = array(
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        );
        $pdo = new \PDO($config::PDO_DSN, $config::PDO_USER, $config::PDO_PASSWORD, $opt);
        self::$connection = $pdo;
    }
}