<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FWAP\Core\FWCols\FWAPColections;

/**
 * Description of RecursiveIteratorIterator
 *
 * @author artphotografie
 */
class RecursiveIteratorIterator {

    /**
     * @var array
     */
    private $elements;

    //put your code here

    public function __construct($elements) {

        $this->elements = $elements;
    }

    public function recursiveIteratorIterator() {

        $obj = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($this->elements));
       echo $obj->rewind();
        return iterator_to_array($obj, TRUE);
    }

}
