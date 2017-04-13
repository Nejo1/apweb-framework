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
 * Time: 10:59 AM
 */
use FWAP\Core\Controller\Controller;
use \FWAP\Core\View\View;
use FWAP\Core\Language\Language;

class index extends Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {

        $this->view->data['welcome_text'] = $this->language->get('welcome_text');
        $this->view->data['welcome_message'] = $this->language->get('welcome_message');
        $this->view->data['inf_1'] = $this->language->get('inf_1');
        $this->view->data['inf_2'] = $this->language->get('inf_2');
        $this->view->data['inf_3'] = $this->language->get('inf_3');
        $this->view->data['r_1'] = $this->language->get('r_1');
        $this->view->data['r_2'] = $this->language->get('r_2');
        $this->view->data['r_3'] = $this->language->get('r_3');

        $this->view->render($this, 'index');
    }

}
