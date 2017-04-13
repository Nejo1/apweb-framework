<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FWAP\core\Engine;

/**
 * Description of ClassLoader
 *
 * @author artphotografie
 */
class ClassLoader {

    /** 
     * The register Directores
     * @var type array
     */
    protected static $directores = [];
    
    /**
     *
     * @var type bool
     */
    protected  static $registered = false;
    
    /**
     * 
     * @param type $class
     * @return bool
     */
    public static function load($class){
        $class = static::normalizeClass($class);
        
        foreach (static::$directores as $directory) {
            if(file_exists($path = $directory.DS.$class )){
                require_once $path;
                return true;
            }
        }
        return false;
    }
    /**
     * 
     * @param type $class
     */
    public static function normalizeClass($class){
        if($class[0] == '\\'){
            $class = substr($class, 1);
        }
        return str_replace(['\\', '_'], DS, $class). '.php';
    }
    
    public static function register(){
        if(!static::$registered){
            static::$registered = spl_autoload_register([static::class, 'load']);
        }
    }
    
    public static function  addDirectores($directores){
        static::$directores = array_unique(array_merge(static::$directores, (array) $directores));
    } 
    
    public static function removeDirectores($directores = null){
        if(is_null($directores)){
            static::$directores = [];
        }else {
            static::$directores = array_diff(static::$directores, (array) $directores);
        }
    }
    
    public static function getDirectores(){
        return static::$directores;
    }
}
