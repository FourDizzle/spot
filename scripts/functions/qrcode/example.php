<?php

session_start();

require("qrlib.php");

$filename="temp".session_id().".png";

QRcode::png("http://php-drops.blogspot.com/", $filename,'S',6,1);

echo '<img src="'.$filename.'" />';

?>