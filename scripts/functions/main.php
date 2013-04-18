<?php

include_once 'directory.php';
include_once 'database.php';

class Main
{
    
    function getStylesheet() {
            echo(file_paths::getStyleSheetPath());
    }
    
    /* creates a compressed zip file */
    function create_zip($files = array(),$destination = '',$overwrite = false) {
            //if the zip file already exists and overwrite is false, return false
            if(file_exists($destination) && !$overwrite) { return false; }
            //vars
            $valid_files = array();
            //if files were passed in...
            if(is_array($files)) {
                    //cycle through each file
                    foreach($files as $file) {
                            //make sure the file exists
                            if(file_exists($file)) {
                                    $valid_files[] = $file;
                            }
                    }
            }
            //if we have good files...
            if(count($valid_files)) {
                    //create the archive
                    $zip = new ZipArchive();
                    if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
                            return false;
                    }
                    //add the files
                    foreach($valid_files as $file) {
                            $zip->addFile($file,$file);
                    }
                    //debug
                    //echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;

                    //close the zip -- done!
                    $zip->close();

                    //check to make sure the file exists
                    return file_exists($destination);
            }
            else
            {
                    return false;
            }
    }
    
    
    function getSpotDetails($id){
        try {
            //connect to database
            $link = DbConnect::dbLink();
            //select all information on a spot
            $selectSpot = "SELECT COUNT(id) FROM location WHERE id = $id;";
            //create handle to hold sql functions
            $handle = $link->prepare($selectSpot);
            //execute query
            $handle->execute();
            $result = $handle->fetchAll(\PDO::FETCH_OBJ);
            //Use only the first result there should not be and duplicates anyway
            $row = $result[0];
            return $row;
        } catch (PDOException $ex) {
            echo('THERE WAS AND ERROR! <br />');
            echo($ex);
            return false;
        }
        
    }
    
    #This function generates a new DB entry without any info
    #The function returns the unique id of the location
    function generateLocation(){
        //establish DB connection
        $link = DbConnect::dbLink();
        //create location id auto increments
        $query = "INSERT INTO `location` (`lat`, `lon`)"
                 . "VALUES ('0.000000', '0.000000');";
        
        $link->exec($query);
        $insertID = $link->lastInsertId();
        
        return $insertID;
    }
    
    #this function generates a QR based on a location id
    #and returns the full-qualified image path
    function generateQR($id) {
        #make qr code
        require("qrcode/qrlib.php");
        $filename = 
                file_paths::getRoot() . 'images/qrcode/spotcode' . $id . '.png';
        QRcode::png("http://www.spot-qr.com/spotcode.php?id=".$id."&s=true", $filename,'Q',9,1);

        # If you know your originals are of type PNG.
        $qrcode = imagecreatefrompng($filename);
        $watermark = imagecreatefrompng(file_paths::getRoot() . 'images/qrcode/watermark.png');
        imagealphablending($watermark,true);
        imagecopymerge($qrcode, $watermark, 0, 0, 7, 4, 315, 315, 100);

        # Save the image to a file
        $qrpath = file_paths::getRoot() . 'images/qrcode/spotcode'.$id.'.png';
        imagepng($qrcode, file_paths::getRoot() . 'images/qrcode/spotcode'.$id.'.png');
        //$imgpath = 'images/qrcode/spotcode'.$id.'.png';
                
        return $qrpath;
    }
}