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

namespace FWAP\cache;

/**
 * Description of CachApec
 *
 * @author artphotografie
 */
class CachApec {

    private $expire;
    
    
    public function __construct($expire) {
       
        $this->expire = $expire;
        
        $filename = glob(DIR_LOGS . 'cache.*');
        
        if(is_array($filename)){
            foreach ($filename as $file){
                $time = substr(strrchr($file, '.'), 1);
                
                if($time < time() ){
                    if(file_exists($file)){
                        unlink($file);
                    }
                }
            }
        }
    }
    
    public function get($key) {
        
        $filename = glob(DIR_LOGS . 'cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.*');
        
        if($filename) {
            $handle = fopen($filename[0], 'r');
            
            flock($handle, LOCK_SH);
            
            $data = fread($handle, LOCK_UN);
            
            fclose($handle);
            
            return json_decode($data, true);
        }
        return false;
    }
    
    public function set($key, $value) {
                $thiS->delete($key);
		$filename = DIR_LOGS . 'cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.' . (time() + $this->expire);

		$handle = fopen($filename, 'w');

		flock($handle, LOCK_EX);

		fwrite($handle, json_encode($value));

		fflush($handle);

		flock($handle, LOCK_UN);

		fclose($handle);
	}
    
    
    public function delete($key){
        
        $filename = glob(DIR_LOGS . 'cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.*');
        
        if(is_array($filename)){
            foreach ($filename as $file) {
                if(file_exists($file)) {
                    unlink($file);
                }
            }
        }
        
    }
}
