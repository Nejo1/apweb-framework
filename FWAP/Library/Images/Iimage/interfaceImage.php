<?php

namespace FWAP\Library\Images\Iimage;

interface interfaceImage {

    public function save($file, $quality);

    public function resize($width = 0, $heigth = 0, $default = '');
}
