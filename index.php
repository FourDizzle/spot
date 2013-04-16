<?php
include_once 'scripts/functions/main.php';
$functions = new Main();
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php $functions->getStylesheet(); ?>">
<title>Spot - Home</title>
</head>

<body>
<div id="main">

	<div id="header">
    	<h1>Spot</h1>
        <img id="homecode" src="images/layout/homecode.png" alt="QR Code which points to this page" />
        <h2 id="description">
        	<ul>
            	<li>Graffiti</li>
                <li>Augmented reality</li>
                <li>Social Networking</li>
            </ul>
        </h2>
    </div>
    
    <div id="navigation">
    	<ul>
        	<li><a href="index.php">Home</a></li>
            <li><a href="create.php">Create New Spot</a></li>
        </ul>
    </div>
    
    <div id="content">
    	<div class="step">
        	<h3>Scan a code</h3>
            <p>When you find one of our QR codes in the wild, scan it with your smart phone. Our codes have the spot logo in the middle like the one above.
</p>
        </div>
        <div class="step">
        	<h3>Leave a Message</h3>
            <p>Scanning the code will take you to a message board that is linked to its geographical location and an image or sound. Leave a message or just see what others said.</p>
        </div>
        <div class="step">
        	<h3>Make a New Spot</h3>
            <p>If you enjoy using this, click <a href="create.php">Create New Spot</a> and follow the instructions to add new spots wherever you'd like.</p>
        </div>
    </div>
    
    <div id="footer">
    	<div id="footer-navigation">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="create.php">Create New Spot</a></li>
                <li><a href="create.php">Contact</a></li>
            </ul>
    	</div>
        <p>Copyright 2013 - Nick Cassiani</p>
    </div>
</div>
</body>
</html>