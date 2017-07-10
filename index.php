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
 * Time: 10:35 AM
 */
/**
 *
 *
 *
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "FWAP/Config/config.php";
spl_autoload_register(function($class) {

    if (file_exists(str_replace('\\', DS, $class) . '.php'))
        require str_replace('\\', DS, $class) . '.php';

  
});

/**
 *
 * require_once DIR_SYSTEM . ' startup.php';
 *
 */
/**
 *
 * Load the Bootstrap!
 *
 */
$bootstrap = new \FWAP\Library\Bootstrap();
// $bootstrap->setControllerPath('marcio');
// $bootstrap->setModelPath('/Mod/');
$bootstrap->init();
