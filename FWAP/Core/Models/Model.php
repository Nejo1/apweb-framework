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
 * Time: 1:30 PM
 */

namespace FWAP\Core\Models;

use FWAP\Database\Drives\DatabaseMysqli;
use FWAP\Database\Drives\DatabasePDO;
use FWAP\Database\Drives\interfaceDatabase;

class Model implements interfaceModel {

    /**
     * @var DatabasePDO
     */
    public $db;

    /**
     * Model constructor.
     * @param $type  instanci a database Drive
     * @var String
     * if null by default is PDO Drive
     */
    public function __construct($type = null) {

        if ($type == '') {
            $this->db = new DatabasePDO(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
        }
        if ($type == 'PDO') {
            $this->db = new DatabaseMysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        }
    }

    public function MYSQLI() {
        
    }

    public function PDO() {
        
    }

    public function selectAll() {
        
    }

}
