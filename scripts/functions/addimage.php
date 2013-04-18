<?php
include_once 'main.php';
include_once 'spotinfo.php';

$functions = new Main();

//get id of spot that is being edited
$id = $_GET['id'];

//get save spot details
$spot = new Spot($id);

//put details into variable
$name = $spot->getName();
$caption = $spot->getCaption();
$image_path = $spot->getImagePath();

//if there is not image use place holder 
if ($image_path == null) $image_path = 'images/layout/image-preview.png';
else $image_path = substr($image_path, 6);
?>
Name: <input type="text" name="name" id="name" value="<?php echo $name; ?>"/><br />
<image id="image-preview" src="<?php echo $image_path; ?>" alt="image preview" /><br />
Caption: <textarea name="caption" id="caption"><?php echo $caption; ?></textarea>
        
        
        
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
	
        //shows preview of image
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
	
        //uploads all spot information 
	$('#submit-button').on('click', function() {
		document.getElementById("name").innerHTML = randomName;
		var submitName = $('#name').val();
		var caption = $('#caption').val();
		var submitData = new FormData();
                submitData.append("id", "<?php echo $id ?>");
		submitData.append("spotname", submitName);
		submitData.append("caption", caption);
		submitData.append("filename", randomName);
		var submitHttp = new XMLHttpRequest();
		submitHttp.open("POST", "scripts/functions/submit.php", false);
		submitHttp.send(submitData);
		$("#lightbox, #lightbox-panel").fadeOut(300);
                });
	});
</script>