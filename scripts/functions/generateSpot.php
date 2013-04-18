<?php
include_once 'main.php';
include_once 'directory.php';

$functions = new Main();

$spotID = $functions->generateLocation();
$functions->generateQR($spotID);
$spotImagePath = '/spot/spot/images/qrcode/spotcode'.$spotID.'.png';
$spotFilePath = file_paths::getRoot() . 'images/qrcode/spotcode' . $spotID . '.png';

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
