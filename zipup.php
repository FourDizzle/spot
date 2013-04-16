<?php
include_once 'scripts/functions/main.php';

$functions = new Main();

$spotJSON = $_POST[data];

$spotArray = json_decode($spotJSON);
$tempArray = array();

foreach ($spotArray as $fileName) {
    $tempArray[] = substr($fileName, 44);
    copy ($fileName, substr($fileName, 44));
}

$result = $functions->create_zip($tempArray, 'images/temporary/newzip.zip', true);

foreach ($tempArray as $fileName) {
    unlink($fileName);
}

header('Content-type: text/xml');
echo '<spotdata>';
    echo '<zipfilepath>';
        echo 'spot-qr.com/V3/images/temporary/newzip.zip';
    echo '</zipfilepath>';
echo '</spotdata>';