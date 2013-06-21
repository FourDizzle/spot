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

	public static function postComment($name, $message) {
		//connect to the DB
		$link = DBConnect::dbLink();
		//query for comments
		$query = "INSERT INTO comments
				      (name, message)
				      VALUES ($name, $message);";
		$handle = $link->prepare($query);
		//Execute query
		$handle->execute();
	}

	public static function compareDate($postDate) {
		$dateDiff;

		$now = new DateTime();
		$postDate = new DateTime($postDate);
		echo $postDate->format("U") . "<br />";
		$secs = $now->format("U") - $postDate->format("U");
		echo $now->format("U") . "<br />";
		echo $secs . "<br />";
		$bit = array(
	        'years' => $secs / 31556926,
	        'weeks' => $secs / 604800,
	        'days' => $secs / 86400,
	        'hours' => $secs / 3600,
	        'minutes' => $secs / 60,
	        'seconds' => $secs
	        );
		
		if ($secs < 20) {
			$dateDiff = "a few seconds ago";
		} elseif ($secs < 120) {
			$dateDiff = "about a minute ago";
		} elseif ($secs < 3600) {
			$dateDiff = "about " . (int) $bit['minutes'] . " minutes ago";
		} elseif ($secs >= 3600 && $secs < 7200) {
			$dateDiff = "about an hour ago";
		} elseif ($secs > 7200 && $secs < 86400) {
			$dateDiff = "about " . (int) $bit['hours'] . " hours ago";
		} elseif ($secs > 86400) {
			$dateDiff = $postDate->format("n/j/Y");
		}

		return $dateDiff;
	}
} ?> 