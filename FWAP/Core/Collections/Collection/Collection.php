<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FWAP\Core\FWCols\FWAPColections;

/**
 * Description of Colections
 *
 * @author artphotografie
 */
interface Colections implements \IteratorAggregate, \ArrayAccess {

public function getIterator();

public function offsetExists($offset);

public function offsetGet($offset);

public function offsetSet($offset, $value);

public function offsetUnset($offset);


//put your code here
}
