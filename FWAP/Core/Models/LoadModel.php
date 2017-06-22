<?php
/**
 * Created by PhpStorm.
 * User: artphotografie
 * Date: 12/05/17
 * Time: 18:47
 */

namespace FWAP\Core\Models;


class LoadModel
{
    private $model;

    public function __construct()
    {
        $this->model = $this->LoadModel();
    }
    

    /**
     * LoadeModel to load  XModel
     */
    public function LoadModel(string $modelPath = '/Models/') {
        $model = get_class($this) . 'Model';
        $path = PV . APP . $modelPath . $model . '.php';
        if (file_exists($path)) {
            if (is_readable($path)) {
                require_once $path;

                $this->db = new \FWAP\Database\Drives\DatabasePDO(DB_TYPE, DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASS);
                $this->model = new $model($this->db);
            }
        }
    }

}