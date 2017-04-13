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
 * Sql Helper
 *
 */

namespace FWAP\Database;

use FWAP\Database\interfaceSql;

class Sql implements interfaceSql {

    private $select;
    private $insert;
    private $join;

    public function selectAll() {

        return $this->select = "SELECT  * FROM ";
    }

    public static function Hello() {
        echo "ola mLorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa et possimus blanditiis nobis dolores quaerat natus enim necessitatibus, sint a ipsa impedit, optio cupiditate temporibus nisi beatae quo laborum cumque.undo";
    }

}
