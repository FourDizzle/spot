<?php
include_once 'scripts/functions/spotinfo.php';
include_once 'scripts/functions/main.php';
include_once 'scripts/functions/directory.php';

$functions = new Main();

$location_id = $_GET['id'];
$spot = new Spot($location_id);

$name = $spot->getName();
$caption = $spot->getCaption();
$image_path = $spot->getImagePath();

if ($spot->getLat() != '0.000000' &&
	$spot->getLon() != '0.000000' &&
	$image_path != null) {
	header("Location: " . file_paths::getRoot() . "location.php?id=" . $location_id);
} elseif ($spot->getLat() == 0.000000 &&
		  $spot->getLon() == 0.000000 &&
		  $image_path != null) {
	$header = "Location: " . file_paths::getRoot() . "updatespotlatlon.php" . $location_id;
	header("Location: localhost/updatespotlatlon.php?" . $location_id);
	die();
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/spot/layout/stylesheets/style.css">
</head>
<body>
<?php 
if ($image_path == null) $image_path = 'images/layout/image-preview.png';
else $image_path = "images/locations/" . $image_path;
?>
<label>Name:</label>
	<input type="text" name="name" id="name" value="<?php echo $name; ?>"/><br />
<image id="image-preview" src="<?php echo $image_path; ?>" alt="image preview" /><br />
<label>Caption:</label>
	<textarea name="caption" id="caption"><?php echo $caption; ?></textarea>
        
        
        
        <div id="submit">
            <button id="submit-button">Save</button>
        </div>
<input type="file" name="image" id="userimage" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
        //This replaces the file input with something nicer
        document.querySelector('#image-preview').addEventListener('click', function(e) {
        // Use the native click() of the file input.
        document.querySelector('#userimage').click();
        }, false);
        
	var randomName = Math.floor(Math.random()*10000000001);
	var response = '';
	var didImageChange = false;
        //shows preview of image
	$('#userimage').change(function(){
		didImageChange = true;
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
	
        //uploads all spot information 
	$('#submit-button').on('click', function() {
		document.getElementById("name").innerHTML = randomName;
		var submitName = $('#name').val();
		var caption = $('#caption').val();
		var submitData = new FormData();
                submitData.append("id", "<?php echo $location_id ?>");
		submitData.append("spotname", submitName);
		submitData.append("caption", caption);
		if (didImageChange) {
                    submitData.append("filename", randomName);
                } else {
                    submitData.append("filename", "none");
                }
		var submitHttp = new XMLHttpRequest();
		submitHttp.open("POST", "scripts/functions/submit.php", false);
		submitHttp.send(submitData);
		$("#lightbox, #lightbox-panel").fadeOut(300);
                });
	});
</script>
</body>
</html>