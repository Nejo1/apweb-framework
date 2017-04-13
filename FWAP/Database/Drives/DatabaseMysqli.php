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

namespace FWAP\Database\Drives;

use FWAP\Database\Drives\interfaceDatabase;
use mysqli;

class DatabaseMysqli extends mysqli implements interfaceDatabase {

    private $mysqli;
    private $limit;
    private $table = array();
    private $result;

    public function __construct($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME) {
        $this->mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
        $this->conexao();
    }

    public function conexao() {

        if ($this->mysqli->connect_errno) {
            throw new \Exception("Error: " . mysqli_error($this->mysqli) . '<br/>
            Error No: ' . mysqli_errno($this->mysqli) . '<br/> 
            Error in: <b>' . $trace[1]['file'] . '</b> line <b>' . $trace[1]['line'] . '</b><br/>' . $sql);
        }
    }

    public function select($sql, $array = array(), $fetchMode = MYSQLI_ASSOC) {


        if ($this->result = $this->mysqli->query($sql))
            ;
//            $this->message();

        while ($this->myrow = $this->result->fetch_all($fetchMode)) {
            return $this->myrow;
        }
        $this->result->close();
    }

    public function insert($table, $data) {

        ksort($data);

        $fieldName = implode(', ', array_keys($data));
        $fieldValues = implode("', '", array_values($data));

        $this->result = $this->mysqli->query("INSERT INTO $table ($fieldName) VALUES ('$fieldValues')");
        $this->mysqli->close();
    }

    public function insert2($table, array $data) {

        $fieldName = implode(',', array_keys($data));
        foreach (array_values($data) as $value) {

            isset($fieldva) ? $fieldva .= ',' : $fieldva = '';
            $fieldva .= '\'' . $this->mysqli->real_escape_string($value) . '\'';
        }
        $this->mysqli->real_query('INSERT INTO ' . $table . ' (' . $fieldName . ') VALUES (' . $fieldva . ')');
        $this->mysqli->close();
    }

    public function update($table, $data, $where) {
        $fieldetail = Null;

        foreach ($data as $key => $value) {
            $fieldetail .= "$key= $$key, ";
        }

        $fieldetail = trim($fieldetail, ',');
        $this->mysqli->real_query("UPDATE $table SET $fieldetail WHERE $where");

        $this->mysqli->close();
    }

    public function delete($table, $where, $limit = 1) {
        
    }

    public function message() {
        printf("Delect return %d rowns. \n", $this->result->num_rows);
    }

}
