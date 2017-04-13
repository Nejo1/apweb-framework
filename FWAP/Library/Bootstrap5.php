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

use \FWAP\Exception\Exception;
use \FWAP\Library\Session;

class Bootstrap {

    private $_url = null;
    private $_controller = "";
    private $method = "";
    private $parems = "";
    private $_controllerPath = PV . APP . '/Controllers/';
    private $_modelPath = 'Models';
    private $_errorPath = 'Error.php';
    private $_defaultFile = 'index.php';

    /**
     *
     */
    public function init() {
        $this->_geturl();
        $this->_getDefaultController();
        $this->_callControllerMethod();
        $this->_callControllerParam();
        $this->_loadExistsController();
        //  $this->_loadDefaultController();
    }

    /**
     * Fetches the $_GET from 'url'
     */
    private function _geturl() {
        $url = $_GET['url'] ?? "index/index";
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $this->_url = explode("/", $url);
    }

    /**
     * (Optional) Set a custom path to controllers
     * @param string $path
     */
    public function setControllerPath($path) {
        $this->_controllerPath = trim(DIR_FILE . $path, DS) . DS;
    }

    /**
     * (Optional) Set a custom path to models
     * @param string $path
     */
    public function setModelPath($path) {

        $this->_modelPath = trim(DIR_FILE . $path, DS) . DS;
    }

    /**
     * (Optional) Set a custom path to the error file
     * @param string $path Use the file name of your controller, eg: error.php
     */
    public function setErrorFile($path) {
        $this->_errorPath = trim($path, DS);
    }

    /**
     * (Optional) Set a custom path to the error file
     * @param string $path Use the file name of your controller, eg: index.php
     */
    public function setDefaultFile($path) {
        $this->_defaultFile = trim($path, DS);
    }

    /**
     * If a method is passed in the GET url paremter
     *
     *  http://localhost/controller/
     *  url[0] = Controller
     *
     */
    private function _getDefaultController() {

        if (isset($this->_url[0])) {
            $this->_controller = $this->_url[0];
        }
    }

    /**
     * If a method is passed in the GET url paremter
     *
     *  http://localhost/controller/method/
     *  url[0] = Controller
     *  url[1] = Method
     *
     */
    private function _callControllerMethod() {
        if (isset($this->_url[1])) {
            if ($this->_url[1] != "") {
                $this->method = $this->_url[1];
            }
        }
    }

    /**
     * If a method is passed in the GET url paremter
     *
     *  http://localhost/controller/method/(param)/(param)/(param)
     *  url[0] = Controller
     *  url[1] = Method
     *  url[2] = Param
     *  url[3] = Param
     *  url[4] = Param
     */
    private function _callControllerParam() {
        if (isset($this->_url[2])) {
            if ($this->_url[1] != "") {
                $this->parems = $this->_url[2];
            }
        }
    }

    public function _loadDefaultController() {

        require_once $this->_controllerPath . $this->_defaultFile;
        $this->_controller = new Index();
        $this->_controller->index();
    }

    /**
     * Load an existing controller if there IS a GET parameter passed
     *
     * @return boolean|string
     */
    private function _loadExistsController() {

        if (file_exists(PV . APP)) {
            $this->_controllerPath .= $this->_controller . '.php';
            if (file_exists($this->_controllerPath)) {
                require_once $this->_controllerPath;
                if (class_exists($this->_controller)) {

                    $this->_controller = new $this->_controller();
                } else {

                    Exception::Controller($this->_controllerPath);
                }
            } else {
                Exception::createController($this->_controller);
            }

            if (isset($this->method)) {
                if (method_exists($this->_controller, $this->method)) {
                    if (isset($this->parems)) {
                        call_user_func(array($this->_controller, $this->method), $this->parems);
                    } else {
                        call_user_func(array($this->_controller, $this->method));
                    }
                }
                try {
                    $this->_controller->index($this->parems);
                } catch (Exception $e) {
                    echo "string" . $e . getMessage('gggggggg');
                }
            } // fim da verificacao d method
        } else {
            Exception::createPathInModeule();
        }

//fim da funcao
    }

}

//fim da class
