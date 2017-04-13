<?php

namespace FWAP\core\Engine;

final class Loader {

    private $registry;

    public function __construct($registry) {


        $this->registry = $registry;
    }

    public function controller($route, $data = array()) {

        // Sanitize the Call

        $route = preg_replace('/[^a-zA-Z0-9_\/]/', '', (string) $route);
        // Trigger the pre events

        $result = $this->registry->get('event')->trigger('controller/' . $route . '/before', array(&$route, &$data));

        if ($result) {
            return $result;
        }
    }

}
