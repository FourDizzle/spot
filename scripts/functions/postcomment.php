<?php
include 'comments.php';
 
// Grab POST data
 $name = $_POST['name'];
 $message = $_POST['message'];
 $id = $_POST['id'];

 // Add comments to DB
 Comments::postComment($name, $message, $id);