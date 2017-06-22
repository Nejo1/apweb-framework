<?php

/**
 * Created by PhpStorm.
 * User: artphotografie
 * Date: 02/01/16
 * Time: 04:05
 */
class ShowDatabase extends PDO implements \FWAP\Database\DBconnectionInterface
{

    function __construct($DB_TYPE, $DB_HOST, $DB_PORT, $DB_NAME, $DB_USER, $DB_PASS)
    {
        parent::__construct($DB_TYPE . ':host=' . $DB_HOST . ';port=' . $DB_PORT . ';dbname=' . $DB_NAME, $DB_USER, $DB_PASS);
    }



    /**
     * undocumented function
     *
     * @return array
     * @author Marcio Zebedeu
     * */
    public function connection()
    {
        // TODO: Implement connection() method.
    }
}