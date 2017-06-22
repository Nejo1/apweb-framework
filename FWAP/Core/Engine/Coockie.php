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


    function createCookie($name, $value='', $maxage=0, $path='',$domain='', $secure=false, $HTTPOnly=false)
    {
    if(is_array($name))
    {
    list($k,$v)    =    each($name);

    $name    =    $k.'['.$v.']';

    }
    $ob = ini_get('output_buffering');
    // Abort the method if headers have already been sent, except when output buffering has been enabled
    if ( headers_sent() && (bool) $ob === false || strtolower($ob) == 'off' )
        return false;
    if ( !empty($domain) )
    {
        // Fix the domain to accept domains with and without 'www.'.
        if ( strtolower( substr($domain, 0, 4) ) == 'www.' ) $domain = substr($domain, 4);
        // Add the dot prefix to ensure compatibility with subdomains
        if ( substr($domain, 0, 1) != '.' ) $domain = '.'.$domain;
        // Remove port information.
        $port = strpos($domain, ':');
        if ( $port !== false ) $domain = substr($domain, 0, $port);
    }
    // Prevent "headers already sent" error with utf8 support (BOM)
    //if ( utf8_support ) header('Content-Type: text/html; charset=utf-8');
    if(is_array($name))
    {
        header('Set-Cookie: '.$name.'='.rawurlencode($value)
            .(empty($domain) ? '' : '; Domain='.$domain)
            .(empty($maxage) ? '' : '; Max-Age='.$maxage)
            .(empty($path) ? '' : '; Path='.$path)
            .(!$secure ? '' : '; Secure')
            .(!$HTTPOnly ? '' : '; HttpOnly'), false);
    }else{
        header('Set-Cookie: '.rawurlencode($name).'='.rawurlencode($value)
            .(empty($domain) ? '' : '; Domain='.$domain)
            .(empty($maxage) ? '' : '; Max-Age='.$maxage)
            .(empty($path) ? '' : '; Path='.$path)
            .(!$secure ? '' : '; Secure')
            .(!$HTTPOnly ? '' : '; HttpOnly'), false);
    }
    return true;
    }

public function setCookie($name, $date){
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
        return setcookie($name, $date, time()+60*60*24*365, '/', $domain, true);
    }

    public function getCookie($name)
    {
        return $_COOKIE[$name];
    }
}
