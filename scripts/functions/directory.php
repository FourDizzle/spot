<?php

class directory_class {
    private static $imagesPath = '/V3/images/';
    private $scriptPath = 'localhost/V3/script';
    private $dbName = 'ucwdjrrq_conversation';
    private $dbUserName = 'root';    
    private $password = 'root';
    private $dbPath = 'localhost';
    private $styleSheet = 'localhost/layout/stylesheets/style.css';
            
    public function getImagesPath() {        
        return $this::$imagesPath;
    }

    function getScriptPath() {        
        return this::$scriptPath;
    }

    function getDbName() {        
        return this::$dbName;
    }

    function getDbUserName() {
        return this::$dbUserName;
    }

    function getDbPassword() {
        return this::$password;
    }

    function getDbPath() {
        return this::$dbPath;
    }
    
    function getStyleSheetPath() {
        return this::$styleSheet;
    }
}