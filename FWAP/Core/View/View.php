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
 * @property  UserData propriedade gerada e usada para pegar dados do model
 */

namespace FWAP\Core\View;

use FWAP\Core\Models\ModelView;
use FWAP\Exception\Exception;

class View implements iView {

    /**
     * @param $controller $this responsavel para pegar a pasta da View
     * @param $view index responsavel em pegar  os arquivos index da pasta do controller
     */
    private $controllers;

    /**
     * @param $controller
     * @param $view
     */
    public function render($controller, String $view = NULL) {
        $this->controllers = get_class($controller);

        if (file_exists(VIEW)) {
            if (is_readable(VIEW)) {

                if (file_exists(VIEW . 'header.phtml')) {
                    if (is_readable(VIEW . 'header.phtml')) {

                        require_once VIEW . 'header.phtml';
                    }
                }
            } else {
                Exception::notHeader();
            }

            if(null == $view) {
                require_once VIEW . $this->controllers . DS .'index.phtml';


        }else {
                if (file_exists(VIEW . $this->controllers)) {
                    if (is_readable(VIEW . $this->controllers)) {

                        if (file_exists(VIEW . $this->controllers . DS . $view . '.phtml')) {
                            if (is_readable(VIEW . $this->controllers . DS . $view . '.phtml')) {

                                require_once VIEW . $this->controllers . DS . $view . '.phtml';
                            }
                        }
                    } else {
                        Exception::notIndex($this->controllers);
                    }
                } else {
                    Exception::noPathinView($this->controllers);
                }
            }
            if (file_exists(VIEW . 'footer.phtml')) {
                if (is_readable(VIEW . 'footer.phtml')) {

                    require_once VIEW . 'footer.phtml';
                }
            } else {
                Exception::notFooter();
            }
        } else {
            Exception::noPathView();
        }
    }

}


