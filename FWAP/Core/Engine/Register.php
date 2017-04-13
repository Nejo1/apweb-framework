<?php

namespace FWAP\core\Engine;

final class Register {

    private $data = array();

    public function get($key) {
        return (isset($this->data[$key]) ?? : null);
    }

    public function set($key, $value) {
        $this->data[$key] = $value;
    }

    public function has($key) {
        return isset($this->data[$key]);
    }

}
