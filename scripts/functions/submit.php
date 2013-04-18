<?php

include_once 'database.php';
include_once 'directory.php';

//connect to DB
$link = DbConnect::dbLink();

$id = $_POST['id'];
$spotName = $_POST['spotname'];
$caption = $_POST['caption'];
$filepath = $_POST['filename'];
$newfilepath = file_paths::getRoot() . "images/locations/" . $filepath;

//Move temporary image to permanant location
copy(file_paths::getRoot() . "images/temporary/" . $filepath, $newfilepath);

//query to change spot/location data
if ($filepath != 'none') {
    $query = "UPDATE location " .
                "SET name='$spotName', caption='$caption', image_path='$filepath' " .
                "WHERE id=$id;";
} else {
    $query = "UPDATE location " .
                "SET name='$spotName', caption='$caption' " .
                "WHERE id=$id;";
}

//execute query
$link->exec($query);