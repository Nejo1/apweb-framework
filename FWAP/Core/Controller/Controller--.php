<?php

/**
 *
 * APWEB Framework (http://framework.artphoweb.com/)
 *
 * @link      http://github.com/zebedeu/artphoweb for the canonical source repository
 * @Copyright (c) 2016.  APWEB Technologies AO Inc. (http://www.artphoweb.com)
 * @license   http://framework.artphoweb.com/license/new-bsd New BSD License
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

use FWAP\Core\Language\iLanguage;
use FWAP\Core\View\iView;
use FWAP\Core\View\View;
use FWAP\Library\Session;
use FWAP\Core\Language\Language;
use FWAP\Core\Components\Components;

/**
 * @property iView iView desacopolamento da View
 * @property iLanguage iLanguage desacopolamento da Language
 */
abstract class Controller {

    public $view;
    public $language;
    public $model;
    public $components;

    /**
     * Controller constructor.
     *  call method function  init
     * View view estancia a class view
     * call method LoadeModel();
     */
    public function __construct(iView $iView, iLanguage $iLanguage) {

        $this->iView = $iView;
        $this->iLanguage = $iLanguage;

        $this->components = new Components();
        Session::init();

        $this->LoadModel();
    }

    /**
     * LoadeModel para carregar o model.php q tenham a estensao _model
     */
    private function LoadModel($modelPath = '/Models/') {
        $model = get_class($this) . '_model';
        $path = PV . APP . $modelPath . $model . '.php';
        if (file_exists($path)) {
            require_once $path;
            $this->model = new $model();
        }
    }

}
