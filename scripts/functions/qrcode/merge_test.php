<?php



#Get id number of user's new location

define('DB_NAME', 'conversation');

	define('DB_USER', 'root');

	define('DB_PASSWORD', '');

	define('DB_HOST', 'localhost');



	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);



	if (!$link) {

		die('Could not connect: ' . mysql_error());

	}



	$db_selected = mysql_select_db(DB_NAME, $link);



	if (!$db_selected) {

		die('Can\'t use ' . DB_NAME . ': ' . mysql_error());

	}

	

	$query = mysql_query('SELECT * FROM `location` WHERE id=(select max(id) from location)');

	$row = mysql_fetch_array($query);



session_start();

require("qrlib.php");

$filename="temp".session_id().".png";

QRcode::png("http://192.168.1.126/website/spotcode.php?id=".$row['id'], $filename,'Q',9,1);

echo '<img src="'.$filename.'" />';



# If you know your originals are of type PNG.

 $image = imagecreatefrompng($filename);

 $frame = imagecreatefrompng('watermark.png');



 imagealphablending($frame,true);

 imagecopymerge($image, $frame, 0, 0, 0, 0, 335, 335, 100);



 # Save the image to a file

 imagepng($image, 'image'.$row['id'].'.png');



# header("Location: newspotcode.php");

?>