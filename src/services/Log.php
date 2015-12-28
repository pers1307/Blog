<?php
/**
 * Log.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\services;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class Log
{
    /** @var Log */
    private static $instance;

    /** @var Logger */
    private $log;

    private function __construct()
    {
        $this->log = new Logger('');
    }

    /**
     * @return Log
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
