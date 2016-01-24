<?php
/**
 * Files.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\service;

use pers1307\blog\db\MySqlConnection;
use KoKoKo\assert\Assert;

class Files
{
    /**
     * @param string $path
     *
     * @return int
     * @throws \InvalidArgumentException
     */
    public function add($path)
    {
        Assert::assert($path, '$path')->notEmpty()->string();

        $connection = (new MySqlConnection())->getConnection();

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

        return (int)$row['id'];
    }

    /**
     * @param int $id
     *
     * @return string|null
     * @throws \InvalidArgumentException
     */
    public function getPathById($id)
    {
        Assert::assert($id, 'id')->positive()->int();

        $connection = (new MySqlConnection())->getConnection();

        $stmt = $connection->prepare('SELECT path FROM files WHERE id = :id');
        $stmt->bindParam('id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $found = $stmt->fetch();

        if (is_null($found)) {
            return null;
        }

        return $found['path'];
    }
}