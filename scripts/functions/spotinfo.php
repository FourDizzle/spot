<?php

include_once 'database.php';
include_once 'main.php';

class Spot {
    
    private $id;
    private $name;
    private $image_path;
    private $lat;
    private $lon;
    private $caption;
    
    function __construct($id) {
        //establish DB connection
        $link = DbConnect::dbLink();
        
        //query to select spot
        $query = "SELECT * FROM location WHERE id = $id;";
        $handle = $link->query($query);
        
        //put results into array and grab the first row
        $results = $handle->fetchAll(PDO::FETCH_ASSOC);
        $row = $results[0];
        
        //set variables to values
        $this->name = $row[name];
        $this->lat = $row[lat];
        $this->lon = $row[lon];
        $this->image_path = $row[image_path];
        $this->caption = $row[caption];
    }
    
    function getName() {
        return $this->name;
    }
    
    function getLat() {
        return $this->lat;
    }
    
    function getLon() {
        return $this->lon;
    }
    
    function getImagePath() {
        return $this->image_path;
    }
    
    function getCaption() {
        return $this->caption;
    }
}
