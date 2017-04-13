<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FWAP\cache;

/**
 * Description of Mem
 *
 * @author artphotografie
 */
use Memcached;
class Mem {

    private $expire;
    private $cache;

    public function __construct($expire) {
        
        $this->expire = $expire;
        
        $this->cache = new \Memcached();
        $this->cache->pconnect(CACHE_HOSTNAME, CAHE_PORT);
    }
    public function get($key){
        return $this->cache->get(FWAP_CACHE . $key);
    }
    public function set($key,$value) {
		return $this->cache->set(FWAP_CACHE . $key, $value, MEMCACHE_COMPRESSED, $this->expire);
	}

	public function delete($key) {
		$this->cache->delete(FWAP_CACHE . $key);
	}
    
}
