<?php
$allowedExts = array("jpg", "jpeg", "gif", "png");
$splitName = explode(".", $_FILES['file']["name"]);
$extension = $splitName[1];
$randString = $_POST["newname"];

$newFileName  = strtolower($randString.'.'.$extension); //join file name and ext.

if ($_FILES['file'] == null) {/*echo "null";*/}
else {
	#echo "not null";
}

if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 7000000)
&& in_array($extension, $allowedExts) {
  if ($_FILES["file"]["error"] > 0)
    {
    #echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    #echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    #echo "Type: " . $_FILES["file"]["type"] . "<br>";
    #echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
   #echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    if (file_exists("../../images/temporary/" . $newFileName))
      {
      unlink("../../images/temporary/" . $newFileName);
	  move_uploaded_file($_FILES["file"]["tmp_name"],
      "../../images/temporary/" . $newFileName);
	  header('Content-type: text/xml');
      echo "<filename>".$newFileName."</filename>";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "../../images/temporary/" . $newFileName);
	  header('Content-type: text/xml');
      echo "<filename>".$newFileName."</filename>";
      }
    }
  }
else {
  echo "Invalid file";
  }
?>