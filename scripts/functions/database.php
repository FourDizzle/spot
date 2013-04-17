<?php
class DbConnect{
    function dbLink(){
        try{
            $link = new \PDO(   'mysql:host=localhost;dbname=conversation',
                                'root',
                                '',
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