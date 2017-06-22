<?php
/**
 * Created by PhpStorm.
 * User: artphotografie
 * Date: 13/05/17
 * Time: 12:39
 */

namespace FWAP\Database;


class MysqlAdapter implements DatabaseAdapterInterface
{
    /**
     * @var array
     */
    private $_config;
    private $_link;
    private $_result;

    public function __construct(array $config)
    {
        if(count($config)!=4) {
            throw new \InvalidArgumentException('Invalid number of connection parameters');
        }
        $this->_config = $config;
    }

    public function connect() {

        if($this->_link === null){
            list($host, $user, $password, $database) = $this->_config;

            if(!$this->_link = @mysqli_connect($host, $user, $password, $database)) {
                throw new \RuntimeException("error connection to the server:" . mysqli_connect_error());
            }
            unset($host, $user, $password, $database);
        }
        return $this->_link;
    }

    public function query($query)
    {
        if(!is_string($query) || empty($query)) {
            throw new  \InvalidArgumentException("the specifiied query is not valid");
        }

        $this->connect();

        if(!$this->_result = mysqli_query($this->_link, $query)) {
            throw new \InvalidArgumentException( "error executing yel speficied query" . mysqli_connect_error());
        }

        return $this->_result;
    }

    public function fetch()
    {
       if($this->_result !== null) {
           if( ($row = mysqli_fetch_array($this->_result, MYSQL_ASSOC))=== false ) {
               $this->freeResult();
           }
           return $row;
       }

       return false;
    }

    public function select($table, $where='' , $fields=' * ', $order='' , $limit=null, $offset= null) {

        $query = 'SELECT ' . $fields . ' FROM ' . $table
            . (($where) ? 'WHERE ' . $where: ")
             . (($limit) ? 'LIMIT' . $limit: ")
            . (($offset && $limit) ? ' OFFSET' .$offset:")
             .(($order) ? 'ORDER BY' . $order: " );

        return $this->query($query);


    }
    public function countRows()
    {
        return $this->_result !== null ? mysqli_num_rows($this->_result) :0;
    }

    public function freeResult() {
        if($this->_result === null) {
            return false;
        }
        mysqli_free_result($this->_result);
            return true;

    }


}