<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FWAP\core\Engine;

/**
 * Description of Coockie
 *
 * @author artphotografie
 */
class Coockie {
    
    
    public function getCookie(){
    	$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
		return setcookie('cookiename', 'data', time()+60*60*24*365, '/', $domain, false);
    }
}
