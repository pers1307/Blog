<?php
/**
 * MySqlConnection.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\db;

use pers1307\blog\config;

class MySqlConnection
{
    /**
     * @var \PDO
     */
    private static $connection;

    /**
     * @return \PDO
     */
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
        $opt = array(
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        );
        $pdo = new \PDO(config\Config::PDO_DSN, config\Config::PDO_USER, config\Config::PDO_PASSWORD, $opt);
        self::$connection = $pdo;
    }
}