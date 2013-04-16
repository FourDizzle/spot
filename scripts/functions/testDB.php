<?php
include 'spotinfo.php';
$spot = new Spot(1);
?>
<html>
    <body>
            
        <input value="<?php
        echo $spot->getName();
        ?>" />
    </body>
</html>