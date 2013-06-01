<?php

class file_paths {
    
    private static $imagesPath = 'images/';
    private static $scriptPath = 'scripts/';
    private static $dbName = 'conversation';
    private static $dbUserName = 'root';    
    private static $password = '';
    private static $dbPath = 'localhost';
    private static $styleSheet = 'layout/stylesheets/style.css';
    private static $root = '/spot/';
    private static $functionPath = 'scripts/functions/';
            
    static function getImagesPath() {        
        return self::$root . self::$imagesPath;
    }

    static function getScriptPath() {        
        return self::$root . self::$scriptPath;
    }

    static function getDbName() {        
        return self::$dbName;
    }

    static function getDbUserName() {
        return self::$dbUserName;
    }

    static function getDbPassword() {
        return self::$password;
    }

    static function getDbPath() {
        return self::$dbPath;
    }
    
    static function getStyleSheetPath() {
        return self::$root . self::$styleSheet;
    }
    
    static function getRoot() {
        $directory = $_SERVER['DOCUMENT_ROOT'] . self::$root;
        return $directory;
    }
    
    static function getFunctionsPath() {
        return self::$functionPath;
    }
    
    static function getServerPath() {
        return 'http://localhost' . self::$root;
    }
}