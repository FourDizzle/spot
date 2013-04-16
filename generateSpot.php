<?php
include 'scripts/functions/main.php';

$functions = new Main();

$spotID = $functions->generateLocation();
$functions->generateQR($spotID);
$spotImagePath = 'http://spot-qr.com/V3/images/qrcode/spotcode'.$spotID.'.png';
$spotFilePath = '/home/ucwdjrrq/public_html/V3/images/qrcode/spotcode' . $spotID . '.png';

header('Content-type: text/xml');
echo('<spotdata>');	
    echo('<SpotImagePath>');
        echo($spotImagePath);
    echo('</SpotImagePath>');
    echo('<SpotFilePath>');
        echo($spotFilePath);
    echo('</SpotFilePath>');
    echo('<SpotID>');
        echo($spotID);
    echo('</SpotID>');
echo('</spotdata>');
