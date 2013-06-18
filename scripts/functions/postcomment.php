<?php
include 'comments.php';
 
// Grab POST data
 $name = $_POST['name'];
 $message = $_POST['message'];

 // Add comments to DB
 Comments::postComment($name, $message);