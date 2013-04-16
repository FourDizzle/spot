<?php

include_once 'main.php';
include_once 'database.php';

$functions = new Main();

//connect to DB
$link = DbConnect::dbLink();

$id = $_POST['id'];
$spotName = $_POST['spotname'];
$caption = $_POST['caption'];
$filepath = $_POST['filename'];
$newfilepath = "../../images/location/" . $filepath;

//Move temporary image to permanant location
copy("../../images/temporary/" . $filepath, $newfilepath);

//query to change spot/location data
$query = "UPDATE location " .
            "SET name='$spotName', caption='$caption', image_path='$newfilepath' " .
            "WHERE id=$id;";

//execute query
$link->exec($query);