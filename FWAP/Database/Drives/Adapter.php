<?php

/**
 * Created by PhpStorm.
 * User: artphotografie
 * Date: 13/05/17
 * Time: 17:59
 */

namespace FWAP\Database\Drives;

class Adapter
{
    /**
     * @var \FWAP\Database\Drives\interfaceDatabase
     */
    private $c;

    function __construct(DatabaseAdapterInterface $c)
    {
        $this->c = $c;
    }


    public function find()
    {
        return $this->c->select("usuarios", 'id', 'id' );
    }
}