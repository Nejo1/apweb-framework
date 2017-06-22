<?php
/**
 * Created by PhpStorm.
 * User: artphotografie
 * Date: 13/05/17
 * Time: 12:42
 */

namespace FWAP\Database;


interface DatabaseAdapterInterface
{
    public function query($query);
    public function fetch();
    public function select($table, $where="", $fields='*', $order="", $limit=null, $offset= null);
    public function countRows();

    }