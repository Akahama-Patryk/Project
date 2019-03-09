<?php

class Autoloader
{
    protected static $fileExt = '.php';

    protected static $pathTop = __DIR__;

    protected static $fileIterator = null;

    public static function loader($classname){
        $directory = new RecursiveDirectoryIterator(static::$pathTop, RecursiveDirectoryIterator::SKIP_DOTS);
        if(is_null(static::$fileIterator)) {
            static::$fileIterator = new RecursiveIteratorIterator($directory, RecursiveIteratorIterator::LEAVES_ONLY);
        }
        $filename = $classname . static::$fileExt;

        foreach (static::$fileIterator as $file) {
            if (strtolower($file->getFilename()) === strtolower($filename)){
                if ($file->isReadable()) {
                    include_once $file->getPathname();
                }
                break;
            }
        }
//        require_once ('User.php');
//        require_once ('Product.php');
        }
        public static function setFileExt($fileExt){
            static::$fileExt = $fileExt;
        }

        public static function setPath($path){
        static::$pathTop = $path;
        }

    public static function sessionStarter(){
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
}

Autoloader::setFileExt('.php');
spl_autoload_register('Autoloader::loader');