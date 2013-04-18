<?php
include_once 'directory.php';

class DbConnect{
        
    static function dbLink(){
        
        $username = file_paths::getDbUserName();
        $password = file_paths::getDbPassword();
        $dbname = file_paths::getDbName();
        $dblocation = file_paths::getDbPath();
    
        try{
            $link = new \PDO(   "mysql:host=$dblocation;dbname=$dbname",
                                "$username",
                                "$password",
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