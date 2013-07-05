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
$image_path = file_paths::getImagesPath() . 'locations/' . $spot->getImagePath();

// Generate header
$functions = new Main();
$functions->getHeader("Location - " . $spot->getName());
?>
	<body>
		<div id="main">
			<div id="header-regular">
		    	<h1 id="regular">
		    		<?php if ($spot->getName() == null) {
		    			echo "Untitled";
		    		} else {
		    			echo $spot->getName();
		    			} 
		    		?>
		    	</h1>
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
		    	<?php
		    		if ($spot->getCaption() != null) {
		    	    	echo "<div id=\"location-caption\">\n" .
		    				"<p>\n" .
		    					$spot->getCaption() .
		    				"\n</p>\n" .
		    				"</div>\n";
		    		} ?>
				<div id = "comments">
					<div id = "comment-container">
						<?php Comments::getComments($location_id); ?>
					</div>
					<div id="add-comment">
						<form id="comment">
							<h3>Leave a Message:</h3>
							<!--<label>Name:</label>-->
								<input type="text" id="name" placeholder="Name" /><br />
							<!--<label>Message:</label>-->
								<textarea type="text" id="message" placeholder="Comment" ></textarea>
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

		if (getUrlVars()["gps"]) {
			var latLon = new Array();
			latLon = getLatLon();
		}

		function postComment() {
		var name = $('input#name').val();
		var message = $('textarea#message').val();
		var id = $('input#id').val();
		if (message != "") {
			$('#comment-container').append(
				"<div class=\"comment\">\n" +
				"<div class=\"message\">\n" +
				"<h4>" + name + "</h4>\n" +
				"	<p>" + message + "</p>\n" +
				"	<p class=\"comment-date\">a few seconds ago</p>\n" +
				"</div>\n" +
				"</div>\n"
				);
			$.post('scripts/functions/postcomment.php', 
					{ name : name, message: message, id: id}, 
					function(result){ 
						//$('#comment-container').append(result);
        			}, 'html');
			$('input#name').val("");
			$('textarea#message').val("");
			}
		}

		$('textarea#message').keypress(function(event){
			var keycode = (event.keyCode ? event.keyCode : event.which);
				if(keycode == '13'){
					postComment();
				}
		});

		$('input#name').keypress(function(event){
			var keycode = (event.keyCode ? event.keyCode : event.which);
				if(keycode == '13'){
					postComment();
				}
		});

		$('#post-comment').click(function(){
			postComment();
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