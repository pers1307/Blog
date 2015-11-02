<?php
/**
 * DefaultConfig.php
 *
 * @category    DefaultConfig
 * @package     Blog
 * @subpackage  Db
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @version     2.0
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\db;

abstract class DefaultConfig
{
    const HTTP_HOST    = 'localhost';
    const PDO_DSN      = 'mysql:dbname=myblog;host=127.0.0.1';
    const PDO_USER     = 'pers';
    const PDO_PASSWORD = '13071992';
}