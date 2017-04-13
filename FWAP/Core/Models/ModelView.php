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

namespace FWAP\Core\Models;

use FWAP\Core\Controller\iController;
use ArrayObject;
use FWAP\Core\View\iView;

class ModelView implements iController {

    public function __construct() {


        $this->LoadModel();
    }

    public function LoadModel($modelPath = '/Models/') {
        $model = get_class($this) . '_model';
        $path = PV . APP . $modelPath . $model . '.php';
        if (file_exists($path)) {
            require_once $path;
            $this->model = new $model();
        }
    }

}
