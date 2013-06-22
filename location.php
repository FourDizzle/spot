<?php 
include_once 'scripts/functions/comments.php';
include_once 'scripts/functions/main.php';
include_once 'scripts/functions/spotinfo.php';
include_once 'scripts/functions/directory.php';

// Get id number of spot
$location_id = $_GET['id'];
// Get spot info from id number
$spot = new Spot($location_id);
// Get image path
$image_path = file_paths::getImagesPath() . '/locations/' . $spot->getImagePath();

// Generate header
$functions = new Main();
$functions->getHeader("Location" . $spot->getName());
?>
	<body>
		<div id="main">
			<div id="header-regular">
		    	<h1 id="regular"><?php echo $spot->getName(); ?></h1>
		    </div>
		    
		    <div id="navigation">
		    	<ul>
		        	<li><a href="index.php">Home</a></li>
		            <li><a href="create.php">Create New Spot</a></li>
		        </ul>
		    </div>
		    
		    <div id="content">
		    	<div id="location-images">
		    		<img src="<?php echo($image_path); ?>" />
		    	</div>
				<div id = "comments">
					<div id = "comment-container">
						<?php Comments::getComments($location_id); ?>
					</div>
					<div id="add-comment">
						<form>
							<label>Name:</label>
								<input type="text" id="name" />
							<label>Message:</label>
								<input type="text" id="message" />
								<input type="hidden" id="id" value="<?php echo $location_id; ?>" />
						</form>
						<button id="post-comment">Post</button>
					</div>
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
	<script>
	$(document).ready(function(){
		$('#post-comment').click(function(){
			var name = $('input#name').val();
			var message = $('input#message').val();
			var id = $('input#id').val();
			$.post('scripts/functions/postcomment.php', 
					{ name : name, message: message, id: id}, 
					function(result){ 
						$('#comment-container').append(result);
        			}, 'html');
		});
	});
	</script>
	<script>
	$(document).ready(function(){
		var location_id = $('input#id').val();
		var commentPoll = setInterval(function(){
			$.post('scripts/functions/getcomments.php', {id: location_id}, function(result) {
				$('#comment-container').html(result);
			});
		}, 60000);
	});
	</script>
	</body>
</html>	