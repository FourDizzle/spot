//sends image and returns filename on server
function postImage(file, filename) {
	var formData = new FormData();
		formData.append("file", file);
		formData.append("newname", filename);
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("POST", "scripts/functions/upload.php", false);
		xmlhttp.send(formData);
		return xmlhttp.responseXML.getElementsByTagName('filename')[0].childNodes[0].nodeValue;
}

//saves entire spot information
function postSpot(id, name, caption, filename) {
	var submitData = new FormData();
	submitData.append("id", id);
	submitData.append("spotname", name);
	submitData.append("caption", caption);
	submitData.append("filename", filename);
	var submitHttp = new XMLHttpRequest();
	submitHttp.open("POST", "scripts/functions/submit.php", false);
	submitHttp.send(submitData);
}

function postSpot(id, name, caption, filename, lat, lon) {
	var submitData = new FormData();
	submitData.append("id", id);
	submitData.append("spotname", name);
	submitData.append("caption", caption);
	submitData.append("filename", filename);
	submitData.append("lat", lat);
	submitData.append("lon", lon);
	var submitHttp = new XMLHttpRequest();
	submitHttp.open("POST", "scripts/functions/submit.php", false);
	submitHttp.send(submitData);
}

function postGPS(id, lat, lon) {
	var submitData = new FormData();
	submitData.append("id", id);
	submitData.append("lat", lat);
	submitData.append("lon", lon);
	var submitHttp = new XMLHttpRequest();
	submitHttp.open("POST", "scripts/functions/updategps.php", false);
	submitHttp.send(submitData);
}

//get gps and return array of lat and lon
function getLatLon() {
	function getLocation() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition);
		} else {
			x.innerHTML="Geolocation is not supported by this browser.";
		}
	}

	function showPosition(position) {
		var latitude = position.coords.latitude;
		var longitude = position.coords.longitude;
		latLon[0] = latitude;
		latLon[1] = longitude;
	}

	var latLon = new Array();
	getLocation();
	return latLon;
}

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}