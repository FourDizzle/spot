<?php
include_once 'comments.php';

$location_id = $_POST['id'];

Comments::getComments($location_id);
