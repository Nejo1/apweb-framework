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

namespace FWAP\Database;

use FWAP\Database\Drives\interfaceDatabase;
use PDO;

 class DBconnection extends PDO {

    /**
     * undocumented class variable
     *
     * @params array
     * */
    private $params = array();

    /**
     * undocumented class variable
     *
     * @_instances array
     * */
    private $_instances = array();

    /**
     * undocumented class variable
     *
     * @var string
     * */
    private $beginTransactioncount = 0;

    function __construct($params) {
        $this->params = $params;
    }

    /**
     * undocumented function
     *
     * @return array
     * @author Marcio Zebedeu 
     * */
    protected function connection() {
        if (empty($this->_instances['db']) || !is_array($this->_instances['db'])) {

            try {
                $this->_instances['db'] = new PDO($this->params['dns'], $this->params['pass'], $this->params['users']);
            } catch (\PDOException $exc) {
                throw new \Exception('Failed to connect to database. Reason: \'' . $exc->getMessage());
            }
        }

        // $attributes = array(
        //     "AUTOCOMMIT", "ERRMODE", "CASE", "CLIENT_VERSION", "CONNECTION_STATUS",
        //     "ORACLE_NULLS", "PERSISTENT", "SERVER_INFO", "SERVER_VERSION"
        // );
        // foreach ($attributes as $value) {
        //     echo "PDO::ATTR_$value: ";
        //     echo $this->_instances['db']->getAttribute(constant("PDO::ATTR_$value")). "\n";
        // }
        return $this->_instances['db'];
    }

// end connection

    /**
     * undocumented function
     *
     * @return bool
     * @author 
     * */
    protected function _beginTransaction() {
        if (!$this->beginTransactioncount && $this->beginTransactioncount++) {
            return parent::beginTransaction();
        }
        return $this->beginTransactioncount >= 0;
    }

    /**
     * undocumented function
     *
     * @return bool
     * @author Marcio Zebedeu
     * */
    protected function _commit() {
        $beginTransactioncount =0;
        if (!++$beginTransactioncount) {
            return parent::commit();
        }
        return $this->beginTransactioncount >= 0;
    }

    /**
     * undocumented function
     *
     * @return bool
     * @author Marcio Zebedeu
     * */
    protected function _Rollback() {
        if ($this->beginTransactioncount >= 0) {
            $this->beginTransactioncount = 0;
            return parent::rollBack();
        }
    }

}
