<?php
include 'scripts/functions/main.php';
$functions = new Main();
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php $functions->getStylesheet(); ?>">
<title>Spot - Create a New Spot</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
 //This replaces the file upload button with something nicer
$(document).ready(function(){
	document.querySelector('#filebutton').addEventListener('click', function(e) {
	  // Use the native click() of the file input.
	document.querySelector('#userimage').click();
	}, false);
});
</script>
<script>
$(document).ready(function() {
	
	$('#submit-button').hide();
	var randomName = Math.floor(Math.random()*10000000001);
	var response = '';
	
	$('#userimage').change(function(){
		var imageToUpload = document.getElementById("userimage").files[0];
		var formData = new FormData();
		formData.append("file", imageToUpload);
		formData.append("newname", randomName);
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("POST", "scripts/functions/upload.php", false);
		xmlhttp.send(formData);
		randomName = xmlhttp.responseXML.getElementsByTagName('filename')[0].childNodes[0].nodeValue;
		document.getElementById("image-preview").setAttribute("src", "images/temporary/"+randomName);
		$('#submit-button').show();
		});
		
	$('#name').keyup(function(){
		var value = $("#name").val();
		if (value === "") {value = "Title Preview";}
		$('#title-preview').html(value);
		});
		
	$('#caption').keyup(function(){
		var caption = $("#caption").val();
		if (caption === "") {caption = "Caption Preview";}
		$('#comment-preview').html(caption);
		});
		
	$('#submit-button').click(function() {
		document.getElementById("name").innerHTML = randomName;
		var submitName = $('#name').val();
		var caption = $('#caption').val();
		var submitData = new FormData();
		submitData.append("spotname", submitName);
		submitData.append("caption", caption);
		submitData.append("filename", randomName);
		var submitHttp = new XMLHttpRequest();
		submitHttp.open("POST", "scripts/functions/submit.php", false);
		submitHttp.send(submitData);
		response = submitHttp.responseXML;
		var qrimagepath = response.getElementsByTagName("qrcode")[0].childNodes[0].nodeValue;
		//$('#photo').append('<img src=\"'+qrimagepath+'\" />');
		$('#image-preview').attr('src', qrimagepath);
		document.getElementById("name").innerHTML = "<a href=\"location.php?id="+response.getElementsByTagName("location")[0].childNodes[0].nodeValue+"\">New Location</a>";
		});
	});
</script>
</head>

<body>
<div id="main">

	<div id="header-regular">
    	<h1 id="regular">Create a New Spot</h1>
    </div>
    
    <div id="navigation">
    	<ul>
        	<li><a href="index.php">Home</a></li>
            <li><a href="create.php">Create New Spot</a></li>
        </ul>
    </div>
    
    <div id="content">
    	<div id="newspotform">
        	<h3>Upload</h3>
        	<label>Name:</label>
            <input type="text" name="name" id="name" />
            <label>Image:</label>
            <button id="filebutton" class="orange">Select Image</button><br />
            <label>Caption:</label>
            <textarea name="caption" id="caption"></textarea>
        </div>
        
        <div id="preview">
        	<h3>Preview</h3>
            <h4 id="title-preview" class="grey-out">Title Preview</h4>
            <image id="image-preview" src="images/layout/image-preview.png" alt="image preview" />
            <p id="comment-preview" class="grey-out">Caption Preview</p>
        </div>
        
        <div id="submit">
        	<button id="submit-button">Generate Your Spot</button>
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
<input type="file" name="image" id="userimage" />
</body>
</html>