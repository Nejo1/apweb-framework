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

namespace FWAP\Helpers;

class Ucfirst {

    /**
     * 
     * @param type $post insert your data ($_POST['NAME'])
     * @param type $a_char it is a array
     * @return type String
     */
    public static function _ucfirst($post, $a_char = array("'", "-", " ")) {

        $string = strtolower($post);
        foreach ($a_char as $temp) {
            $pos = strpos($string, $temp);
            if ($pos) {

                $mend = '';
                $a_split = explode($temp, $string);
                foreach ($a_split as $temp2) {
                    $mend .= ucfirst($temp2) . $temp;
                }
                $string = substr($mend, 0, -1);
            }
        }
        return ucfirst($string);
    }

}
