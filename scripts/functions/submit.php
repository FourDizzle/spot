<?php

include_once 'database.php';
include_once 'directory.php';

//connect to DB
$link = DbConnect::dbLink();

$id = $_POST['id'];
$spotName = $_POST['spotname'];
$caption = $_POST['caption'];
$filename = $_POST['filename'];
$lat = $_POST['lat'];
$lon = $_POST['lon'];

//if image is temporary save it and change img path in DB
if (strrpos($filename, "temporary") !== false) {
	//change filename to array of directory ending in image's name
	$filepath = explode("/", $filename);
	//Move temporary image to permanant location
	$newfilepath = file_paths::getRoot() . "images/locations/" . $filepath[count($filepath)-1];
	echo $newfilepath;
	copy(file_paths::getRoot() . $filename, $newfilepath);
	$filename = $filepath[count($filepath)-1];
	$query = "UPDATE location " .
                "SET name='$spotName', caption='$caption', image_path='$filename' ";
} else {
	$query = "UPDATE location " .
                "SET name='$spotName', caption='$caption' ";
}

if ($lat != null && $lon != null) {
    $query = $query . ",lat='$lat', lon='$lon' ";
}
//add where clause to query
$query = $query . "WHERE id=$id;";
//execute query
$link->exec($query);