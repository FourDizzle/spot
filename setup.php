<?php include 'scripts/functions/main.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Spot Setup</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(onSuccess);
	}
	else {$('#demo').html('<strong>Geolocation is not supported by this browser.</strong>');}
	var onSuccess = function showPosition(position)
  {
  $('#demo').html("Latitude: " + position.coords.latitude +
  "<br>Longitude: " + position.coords.longitude);
  }
});
</script>

</head>

<body>
<div id="demo"></div>
<button onclick="getLocation()">do it</button>
</body>
</html>