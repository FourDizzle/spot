<?php

include_once 'main.php';
include_once 'database.php';
include_once 'directory.php';

class Comments {

	public static function grabComments($id) {
		//connect to the DB
		$link = DBConnect::dbLink();
		//query for comments
		$query = "SELECT *
				      FROM comments 
				      WHERE location_id = $id 
				      ORDER BY postdate ASC;";
		$handle = $link->prepare($query);
		//Execute query
		$handle->execute();
        $result = $handle->fetchAll(\PDO::FETCH_OBJ);
        //return array of comments
        return $result;
	}
} ?>