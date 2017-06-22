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
;
use FWAP\Database\Drives\interfaceDatabase;
use PDO;

 final class DatabasePDOO extends \FWAP\Database\DBconnection implements interfaceDatabase {

    public $conn;
     public $stmt;

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
    public function select($table, $fields="*", $where=' ', $order='', $limit= null, $offset=null,  $array = array(), $fetchMode = PDO::FETCH_ASSOC) {

        $sql = ' SELECT ' . $fields . ' FROM ' . $table
            . (($where) ? ' WHERE ' . $where : " ")
             . (($limit) ? ' LIMIT ' . $limit : " ")
            . (($offset && $limit) ? ' OFFSET ' . $offset : " ")
             . (($order) ? ' ORDER BY ' . $order : " ");
        $this->stmt = $this->conn->prepare($sql);


        foreach ($array as $key => $values) {
            $this->stmt->bindValue("$key", $values);
        }
        $this->stmt->execute();
        do {
            return $this->stmt->fetchAll($fetchMode);
        } while (
            $this->stmt->nextRowset());

    }

    public function selectManager($sql, $array = array(), $fetchMode = \PDO::FETCH_ASSOC)
    {
        $this->stmt = $this->conn->prepare($sql);

        foreach ($array as $key => $values) {
            $this->stmt->bindValue("$key", $values);
        }
        $this->stmt->execute();
        do {
            return $this->stmt->fetchAll($fetchMode);

        } while (
            $this->stmt->nextRowset()) ;



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
            $this->stmt = $this->conn->prepare("INSERT INTO $table (`$fieldNme`) VALUES ($fieldValues)");

            foreach ($data as $key => $values) {
                $this->stmt->bindValue(":$key", $values);
            }
        } catch (Exception $e) {
            $this->_Rollback();
            echo "error insert " . $e->getMessage();
        }



        return $this->stmt->execute();
        unset($this->stmt);
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
            $this->stmt->bindValue(":$key", $values);
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

     public function getTable($table_name = "")
     {
         $output = "";

         if ($table_name === '') {
             $table_name = $_POST['Database'];
         }

         $sql = "SHOW TABLES FROM " . $this->ensureTicks($table_name);
         $result = $this->prepare($sql);

         $output = "<RESULTSET><FIELDS>";


         $output .= "<FIELD><NAME>TABLE_CATALOG</NAME></FIELD>";
         $output .= "<FIELD><NAME>TABLE_SHEMA</NAME></FIELD>";
         $output .= "<FIELD><NAME>TABLE_NAME</NAME></FIELD>";
         $output .= "</FIELD><ROWS>";

         if (is_resource($result)) {
             $stmt ="";
             while ($stmt->fetchall($result) > 0) {

                 $output .= '<ROW><VALUE/><VALUE/><VALUE>' . $stmt[0] . '</VALUE></ROW>';

             }
             $output .= "</ROWS></RESULTSET>";

         }

         return $output;

     }

     private function ensureTicks($inputSQL)
     {
         $outSQL = $inputSQL;
         //added backtick for handling reserved words and special characters
         //http://dev.mysql.com/doc/refman/5.0/en/legal-names.html

         //only add ticks if not already there
         $oLength = strlen($outSQL);
         $bHasTick = false;
         if (($oLength > 0) && (($outSQL[0] == "`") && ($outSQL[$oLength-1] == "`")))
         {
             $bHasTick = true;
         }
         if ($bHasTick == false)
         {
             $outSQL = "`".$outSQL."`";
         }
         return $outSQL;
     }

     public function createTable(String $table, array $fileds){
         ksort($fileds);

         $fieldNme = implode('`,`', array_keys($fileds));
         $fieldValues =  implode('`,`', array_values($fileds[$fieldNme]));

//         echo $fieldNme.' '.$fieldValues;

         $sql = "CREATE TABLE IF NOT EXISTS  apweb.$table ( id INT(11) AUTO_INCREMENT PRIMARY KEY, teste VARCHAR(23) NOT NULL  );" ;

         var_dump($sql);

         $th = $this->conn->exec($sql);

         var_dump($th);

     }


     public function get_Data_definitin($db)
     {
         // TODO: Implement get_Data_definitin() method.
     }
 }
