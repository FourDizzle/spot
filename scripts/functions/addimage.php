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
else $image_path = "images/locations/" . $image_path;
?>
<div id="close"><a id="close-panel" href="#">[X]</a></div>
<!--<label>Name:</label>-->
<image id="image-preview" src="<?php echo $image_path; ?>" alt="image preview" /><br />
	<input type="text" name="name" id="name" placeholder="Spot name" value="<?php echo $name; ?>"/><br />

<!--<label>Caption:</label>-->
	<textarea name="caption" placeholder="Caption" id="caption"><?php echo $caption; ?></textarea>
        
        
        
        <div id="submit">
            <button id="submit-button">Save</button>
        </div>
<input type="file" name="image" id="userimage" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$('#submit-button').hide();
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
		randomName = postImage(imageToUpload, randomName);
		document.getElementById("image-preview").setAttribute("src", "/spot/images/temporary/" + randomName);
		$('#submit-button').show();
		});
	
        //uploads all spot information 
	$('#submit-button').on('click', function() {
		document.getElementById("name").innerHTML = randomName;
		var submitName = $('#name').val();
		var caption = $('#caption').val();
		var imagePath = $('#image-preview').attr('src');
		var id = <?php echo $id ?>;
		postSpot(id, submitName, caption, imagePath);
		$("#lightbox, #lightbox-panel").fadeOut(300);
                });
	});
</script>