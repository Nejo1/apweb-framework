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

namespace FWAP\Library;

/**
 * 
 */
class Log {

    private $handle;

    /**
     * 
     * @param type $filename
     */
    public function __construct($filename) {
        $this->handle = fopen(DIR_LOGS . $filename, 'a');
    }

    /**
     * 
     * @param type $message
     */
    public function write($message) {
        fwrite($this->handle, date('Y-m-d G:i:s') . ' - ' . print_r($message, true) . "\n");
    }

    public function __destruct() {
        fclose($this->handle);
    }
    /**
     * 
     * @param type $files
     * @return type
     */
    public function Files($files) {
        return $this->files = $files;
    }

}
