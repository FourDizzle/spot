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
	$header = "Location: " . file_paths::getRoot() . "location.php?gps=true&" . $location_id;
	header("Location: location.php?gps=true&id=" . $location_id);
	die();
}
?>
<?php 
if ($spot->getName() == null) $title = "New Spot";
else $title = $spot->getName();
$functions->getHeader($title);
?>
<?php 
if ($image_path == null) $image_path = 'images/layout/image-preview.png';
else $image_path = "images/locations/" . $image_path;
?>
<body>

	<div id="main">
		<div id="header-regular">
    	<h1><?php echo $title; ?></h1>
    </div>
    
    <div id="navigation">
    	<ul>
        	<li><a href="index.php">Home</a></li>
            <li><a href="create.php">Create New Spot</a></li>
        </ul>
    </div>
    
    <div id="content">

<img class="newspot" id="image-preview" src="<?php echo $image_path; ?>" alt="image preview" /><br />
<!--<label>Name:</label>-->
	<input class="newspot" type="text" placeholder="Spot name" name="name" id="name" value="<?php echo $name; ?>"/><br />
<!--<label>Caption:</label>-->
	<textarea class="newspot" name="caption" placeholder="Caption" id="caption">
		<?php echo $caption; ?></textarea>
<input type="hidden" name="lat" id="lat" value="<?php echo $spot->getLat(); ?>" />
<input type="hidden" name="lon" id="lon" value="<?php echo $spot->getLon(); ?>" />
        
        
        <div id="submit">
            <button class="newspot" id="submit-button">Save</button>
        </div>
<input type="file" name="image" id="userimage" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
</script>
<script>
$(document).ready(function(){
        //This replaces the file input with something nicer
        document.querySelector('#image-preview').addEventListener('click', 
        	function(e) {
        // Use the native click() of the file input.
        document.querySelector('#userimage').click();
        }, false);

        var latLon = new Array();
        latLon = getLatLon();
		$('#lat').val(latLon[0]);
		$('#lon').val(latLon[1]);        
        
	var randomName = Math.floor(Math.random()*10000000001);
	var response = '';
	var didImageChange = false;
        //shows preview of image
	$('#userimage').change(function(){
		didImageChange = true;
        var imageToUpload = document.getElementById("userimage").files[0];
		randomName = postImage(imageToUpload, randomName);
		document.getElementById("image-preview").setAttribute("src", 
			"images/temporary/" + randomName);
		$('#submit-button').show();
		});
	
        //uploads all spot information 
	$('#submit-button').on('click', function() {
		document.getElementById("name").innerHTML = randomName;
		var submitName = $('#name').val();
		var caption = $('#caption').val();
		var imagePath = $('#image-preview').attr('src');
		var id = <?php echo $location_id ?>;
		postSpot(id, submitName, caption, imagePath, latLon[0], latLon[1]);
		window.location = "<?php echo file_paths::getServerPath() . 
			"location.php?id=$location_id"; ?>";
        });
	});
</script>
</div>
</div>
</body>
</html>0