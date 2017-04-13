<?php

/**
 *
 * APWEB Framework (http://framework.artphoweb.com/)
 * APWEB FW(tm) : Rapid Development Framework (http://framework.artphoweb.com/)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @link      http://github.com/zebedeu/artphoweb for the canonical source repository
 * @copyright (c) 2016.  APWEB  Software Technologies AO Inc. (http://www.artphoweb.com)
 * @license   http://framework.artphoweb.com/license/new-bsd New BSD License
 * @author    Marcio Zebedeu - artphoweb@artphoweb.com
 * @version   1.0.0
 */
/**
 * Created by PhpStorm.
 * User: artphotografie
 * Date: 2016/02/14
 * Time: 1:16 PM
 */

namespace FWAP\Database\Drives;

use FWAP\Database\Drives\interfaceDatabase;
use PDO;

final class DatabasePDOO extends \FWAP\Database\DBconnection implements interfaceDatabase {

    private $conn;

    public function __construct() {
        parent::__construct(array('dns' => DB_TYPE . ':host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME, 'pass' => DB_PASS, 'users' => DB_USER));
        $this->conn = $this->connection();
    }

    /**
     * select
     * @param string $sql An SQL string
     * @param array $array Paramters to bind
     * @param constant $fetchMode A PDO Fetch mode
     * @return mixed
     */
    public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC) {

        $stmt = $this->conn->prepare($sql);

        foreach ($array as $key => $values) {
            $stmt->bindValue("$key", $values);
        }
        $stmt->execute();
        do {
            return $stmt->fetchAll($fetchMode);
        } while (
        $stmt->nextRowset());
    }

    /**
     * @param $table da base de dados
     * @param $data recebido do array
     * @return bool
     */
    public function insert($table, $data) {

        krsort($data);

        $fieldNme = implode('`,`', array_keys($data));
        $fieldValues = ':' . implode(',:', array_keys($data));
        try {
            $this->_beginTransaction();
            $stmt = $this->conn->prepare("INSERT INTO $table (`$fieldNme`) VALUES ($fieldValues)");

            foreach ($data as $key => $values) {
                $stmt->bindValue(":$key", $values);
            }
        } catch (Exception $e) {
            $this->_Rollback();
            echo "error insert " . $e->getMessage();
        }



        return $stmt->execute();
        unset($stmt);
    }

    /**
     * @param $table
     * @param $data
     * @param $where
     * @return bool
     */
    public function update($table, $data, $where) {
        ksort($data);

        $fielDetail = null;

        foreach ($data as $key => $values) {
            $fielDetail .= "`$key`=:$key,";
        }

        $fielDetail = trim($fielDetail, ',');
        $stmt = $this->conn->prepare("UPDATE $table SET $fielDetail WHERE $where ");
        foreach ($data as $key => $values) {
            $stmt->bindValue(":$key", $values);
        }

        return $stmt->execute();
    }

    /**
     * @param $table
     * @param $where
     * @param int $limit
     * @return int
     */
    public function delete($table, $where, $limit = 1) {
        return $this->conn->exec("DELETE FROM $table WHERE $where LIMIT $limit");
    }

}
