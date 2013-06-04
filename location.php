<?php 
include_once 'scripts/functions/comments.php';
include_once 'scripts/functions/main.php';
include_once 'scripts/functions/spotinfo.php';

// Get id number of spot
$location_id = $_GET['id'];
// Get spot info from id number
$spot = new Spot($location_id);

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
			<div id = "comments">
				<?php 
				$comments = Comments::grabComments($location_id);
				foreach ($comments as $row) {
					echo "<div class=\"comment\">\n";
					echo "<h4>" . $row->name . "</h4>\n";
					echo "<span class=\"comment-date\">" . $row->postdate . "</span>\n";
					echo "<p>" . $row->message . "</p>\n";
					echo "</div>\n";
				} ?>
			</div>
			<div id="add-comment">
				<form>
					<label>Name:</label>
						<input type="text" id="name" />
					<label>Message:</label>
						<input type="text" id="message" />
				</form>
			</div>
		</div>
	</div>
	</body>
</html>