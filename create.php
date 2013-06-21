<?php
include_once 'scripts/functions/main.php';
include_once 'scripts/functions/directory.php';
$functions = new Main();
$functions->getHeader("Create New Spot");
?>

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
    	<div id="newspotform" class="step">
            <h3>Generate QR Codes</h3>
            <p>Click "Generate New Spot" to create a 
                unique but empty spot for you to fill
                with your art or sound. You can create
                a total of nine spots at any one time.
                Click download when you're done.
            </p>
            <button id="get-spot">Generate New Spot</button>
            <button id="download-spots">Download</button> 
        </div>
        <div id="spot-preview"></div>
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

<div id="lightbox-panel">  
    <h2>Lightbox Panel</h2>  
    <p>You can add any valid content here.</p>  
    <p align="center">  
        <a id="close-panel" href="#">Close this window</a>  
    </p>  
</div>  
<div id="lightbox"> </div>
<input type="file" name="image" id="userimage" />

</div>

<script>
$(document).ready(function() {
    
    var newSpotFilePaths = new Array();
    var numberOfSpots = 0;
    var spotIDArray = new Array();
    var newSpotID = 0;
    
    function startDownload(url) { 
        window.location.assign(url);
    }

    $('#get-spot').click(function() {
        if (numberOfSpots <= 8) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET","scripts/functions/generateSpot.php",false);
            xmlhttp.send();
            xmlDoc = xmlhttp.responseXML;
            spotImagePath = 
                xmlDoc.getElementsByTagName("SpotImagePath")[0].childNodes[0].nodeValue;
            spotFilePath = 
                    xmlDoc.getElementsByTagName("SpotFilePath")[0].childNodes[0].nodeValue;
            spotID = 
                    xmlDoc.getElementsByTagName("SpotID")[0].childNodes[0].nodeValue;
            
            spotIDArray.push(spotID);
            newSpotFilePaths.push(spotFilePath);            
            
            var preview = "<div class=\"newspot\" id=\""+numberOfSpots+"\">"+
                "   <img class=\"showspot\" src=\""+spotImagePath+"\" />"+
                "</div>";  
            
            numberOfSpots++; 
            
            $(preview).hide().appendTo('#spot-preview').fadeIn(1000);
         
             //on click of QR Code get its unique id and insert for to edit
             $(".newspot").click(function(){  
                newSpotID = $(this).attr('id');
                $("#lightbox, #lightbox-panel").fadeIn(300);
                $("#lightbox-panel").html(
                        "<p>"+spotIDArray[newSpotID]+"</p>"+
                        "<iframe src=\"scripts/functions/addimage.php\"></iframe>"+
                        "<a id=\"close-panel\" href=\"#\">Close this window</a>"
                );
                
                var addImageURL = "scripts/functions/addimage.php?id="+spotIDArray[newSpotID];
                
                var xhr = new XMLHttpRequest();
                xhr.open("GET", addImageURL ,false);
                xhr.send();
                var innerHtml = xhr.responseText;
                
                $("#lightbox-panel").html(innerHtml);                
                //Jquery for light box
                         
                //end of light box behavior
                $("a#close-panel").click(function(){  
                    $("#lightbox, #lightbox-panel").fadeOut(300);  
                });
             });
            
             $("a#close-panel").click(function(){  
                 $("#lightbox, #lightbox-panel").fadeOut(300);  
             });
        }
    });
    
    $('#download-spots').click(function(){
        //alert(newSpotFilePaths.join('\n'));
        var filePathPost = JSON.stringify(newSpotFilePaths);
        $.post('scripts/functions/zipup.php', { data : filePathPost }, function(data, success, xhr){
            var zipfilepath = //"http://"+ 
                    data.getElementsByTagName("zipfilepath")[0].childNodes[0].nodeValue;
            startDownload(zipfilepath);
        }, 'xml');
    }); 
});
</script>
</body>
</html>