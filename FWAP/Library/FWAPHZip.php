<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FWAP\Library;

/**
 * Description of FWAPHZip
 * FWAPHZip::zipDir('/path/to/sourceDir', '/path/to/out.zip'); 
 *
 * @author artphotografie
 */
class FWAPHZip {

    /**
     * @var array
     */
    private $filename;

    public function __construct(array $filename = null) {
        $this->filename = $filename;
    }
    
    public static function create($folder, &$zipFile, $length){
        
       $handle = opendir($folder);

       while (false !== $f = readdir($handle)) {
           if($f != '.' && $f != '..'){
            $filePath = "$folder/$f";

            $localPath = substr($filePath, $length);
                if(is_file($filePath)){
                    $zipFile->addFile($filePath, $localPath);
                    self::create($filePath, $zipFile, $length);
                }
            }
           }
           closedir($handle); 
    }

    public static function zipDir($sourcePath, $outZipPath){
        $dirName = "";
        $pathInfo = pathinfo($sourcePath);
        $parentPath = $pathInfo['dirname'];
        /* @var $dirName type */
        $dirName = $pathInfo['basename'];

        $zip = new \ZipArchive();
        $zip->open($outZipPath, \ZipArchive::CREATE);
        $zip->addEmptyDir($dirName);

        self::create($sourcePath, $zip, strlen("$parentPath/"));
        $zip->close();
    }
}






















