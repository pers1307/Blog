<?php
/**
 * Files.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\services;
use pers1307\blog\db\MySqlConnection;

class Files
{
    public function add($path)
    {
        $connection = (new MySqlConnection())->getConnection();

        // вернуть id новой вставленной записи
        $stmt = $connection->prepare(
            'INSERT INTO files(`path`)
                VALUES (:path)'
        );

        $stmt->execute([
            'path' => $path
        ]);

        $stmt = $connection->prepare('SELECT last_insert_id() AS id');
        $stmt->execute();
        $row = $stmt->fetch();

        return $row['id'];
    }
}