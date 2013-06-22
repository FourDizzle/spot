<?php

include_once 'main.php';
include_once 'database.php';
include_once 'directory.php';

class Comments {

	private static function grabComments($location_id) {
		//connect to the DB
		$link = DBConnect::dbLink();
		//query for comments
		$query = "SELECT name, message, UNIX_TIMESTAMP(postdate) as postdate
				      FROM comments 
				      WHERE location_id = $location_id 
				      ORDER BY postdate ASC;";
		$handle = $link->prepare($query);
		//Execute query
		$handle->execute();
        $result = $handle->fetchAll(\PDO::FETCH_OBJ);
        //return array of comments
        return $result;
	}

	public static function putComment($name, $message, $id) {
		//connect to the DB
		$link = DBConnect::dbLink();
		//query for comments
		$query = "INSERT INTO comments
				      (name, message, location_id)
				      VALUES ('$name', '$message', '$id');";
		$handle = $link->prepare($query);
		//Execute query
		$handle->execute();

		return $link->lastInsertID();
	}

	private static function compareDate($postDate) {
		$dateDiff;

		$now = new DateTime();
		$postDate = new DateTime("@$postDate");
		$secs = $now->format("U") - $postDate->format("U");
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
			$dateDiff = (int) $bit['minutes'] . " minutes ago";
		} elseif ($secs >= 3600 && $secs < 7200) {
			$dateDiff = "about an hour ago";
		} elseif ($secs > 7200 && $secs < 86400) {
			$dateDiff = (int) $bit['hours'] . " hours ago";
		} elseif ($secs > 86400) {
			$dateDiff = $postDate->format("n/j/Y g:i A");
		}

		return $dateDiff;
	}

	public static function getComments($location_id) {
		$comments = Comments::grabComments($location_id);
		foreach ($comments as $row) {
			Comments::printComment($row);
		}
	}

	private static function printComment($row) {
		echo "<div class=\"comment\">\n";
		echo "<div class=\"message\">\n";
		echo "<h4>" . $row->name . "</h4>\n";
		echo "	<p>" . $row->message . "</p>\n";
		echo "	<p class=\"comment-date\">" . Comments::compareDate($row->postdate) . "</p>\n";
		echo "</div>\n";
		echo "</div>\n";
	}

	public static function postComment($name, $message, $location_id) {
		//connect to the DB
		$link = DBConnect::dbLink();
		//query for comments
		$id = Comments::putComment($name, $message, $location_id);
		$query = "SELECT name, message, UNIX_TIMESTAMP(postdate) as postdate
				      FROM comments 
				      WHERE id = $id;";
		$handle = $link->prepare($query);
		//Execute query
		$handle->execute();
        $result = $handle->fetchAll(\PDO::FETCH_OBJ);
        //print comment
        foreach ($result as $row) {
			Comments::printComment($row);
		}
	}
} ?> 