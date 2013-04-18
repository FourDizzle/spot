<?php
include_once 'main.php';
include_once 'directory.php';

$functions = new Main();

$spotJSON = $_POST['data'];

$spotArray = json_decode($spotJSON);
$tempArray = array();

foreach ($spotArray as $fileName) {
    $tempArray[] = substr($fileName, 44);
    copy ($fileName, substr($fileName, 44));
}

$result = $functions->create_zip($tempArray, file_paths::getRoot() . 'images/temporary/newzip.zip', true);

foreach ($tempArray as $fileName) {
    unlink($fileName);
}

header('Content-type: text/xml');
echo '<spotdata>';
    echo '<zipfilepath>';
        echo file_paths::getServerPath() . 'images/temporary/newzip.zip';
    echo '</zipfilepath>';
echo '</spotdata>';