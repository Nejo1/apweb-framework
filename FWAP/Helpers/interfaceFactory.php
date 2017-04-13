<?php

namespace FWAP\Helpers;

interface interfaceFactory {

    public function __construct($type = NULL);

    public function getTypeBD($type);

    public function setTypeBD($type);
}
