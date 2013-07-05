<?php
include_once 'database.php';
include_once 'directory.php';

//connect to DB
$link = DbConnect::dbLink();

$id = $_POST['id'];
$lat = $_POST['lat'];
$lon = $_POST['lon'];

$query = "UPDATE location " .
                "SET lat='$lat', lon='$lon' " . 
                "WHERE id=$id;";

$link->exec($query);