<?php

namespace FWAP\Helpers;

use FWAP\Database\DatabasePDO;
use FWAP\Helpers\interfaceFactory;

class Factory {

    public $type;

    public function __construct($type = NULL) {
        $this->type = $type;
        if ($this->type == '') {
            $obj = new DatabasePDO(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
        }
        if ($this->type == "MYSQLI") {
            $obj = new \FWAP\Database\DatabaseMysqli(DB_HOST, DB_NAME, DB_USER, DB_PASS);
        }
        return $obj;
    }

    public function getTypeDB($type = NULL) {
        
    }

    public function setTypeBD($type) {
        $this->type = $type;
    }

}
