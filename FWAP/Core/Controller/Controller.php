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
/**
 * Created by PhpStorm.
 * User: artphotografie
 * Date: 2016/02/14
 * Time: 11:00 AM
 *
 * @property
 */

namespace FWAP\Core\Controller;

use FWAP\Core\View\View;
use FWAP\Library\Session;
use FWAP\Core\Language\Language;
use FWAP\Core\Components\ServiceManager;
use \FWAP\Database\Drives\DatabasePDO;
use FWAP\Library\Log;

/**
 * @property iView iView desacopolamento da View
 * @property iLanguage iLanguage desacopolamento da Language
 */
abstract class Controller implements iController {

    public $view;
    public $language;
    public $model;
    public $compo;
    private $db;
    public $log;
    public $imagem;
    public $getServiceLocator;


    /**
     * Controller constructor.
     *  call method function  init
     * View view estancia a class view
     * call method LoadeModel();
     */
    public function __construct() {

        Session::init();

       

        $this->view = new View();
        $this->breadcrumb = new \FWAP\Library\Breadcrumb();
        $this->language = new Language();
        $this->log = new Log('error.log');
        $this->language->Load('welcome');
        $this->route = new \FWAP\Library\Url();
        $this->imagem = new \FWAP\Helpers\Uploads();
        
         $this->getServiceLocator = new ServiceManager();

        $this->LoadModel();
    }

    /**
     * LoadeModel to load  XModel
     */
    public function LoadModel(String $modelPath = '/Models/') {
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
