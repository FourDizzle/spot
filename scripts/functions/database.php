<?php
class DbConnect{
    function dbLink(){
        try{
            $link = new \PDO(   'mysql:host=localhost;dbname=ucwdjrrq_conversation',
                                'ucwdjrrq',
                                '0x3neD24Dv',
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