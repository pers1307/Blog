<?php
/**
 * DefaultConfig.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\config;

abstract class DefaultConfig
{
    const HTTP_HOST    = 'localhost';
    const PDO_DSN      = 'mysql:dbname=blog;host=127.0.0.1';
    const PDO_USER     = 'root';
    const PDO_PASSWORD = '';
}