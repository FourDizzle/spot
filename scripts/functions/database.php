<?php
include_once 'directory.php';

class DbConnect{
    
    private $username = file_paths::getDbUserName;
    private $password = file_paths::getDbPassword;
    private $dbname = file_paths::getDbName;
    private $dblocation = file_paths::getDbPath;
    
    static function dbLink(){
        try{
            $link = new \PDO(   "mysql:host=$this->dblocation;dbname=$this->dbname",
                                "$this->username",
                                "$this->password",
                                array(
                                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                                    \PDO::ATTR_PERSISTENT => false,
                                    \PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8'
                                )
                            );
            return $link;

        }catch(\PDOException $ex){
            print($ex->getMessage());
            return null;
        }
    }
}