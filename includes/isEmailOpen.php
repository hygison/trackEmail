<?php
    
    /**
     * Confirm if email was open! 
     * Just take the trackCode and search on the database for it, if find, then change to open and store the date
     */
    require 'autoload.inc.php';


    if(isset($_GET["trackCode"])){
        $isOpen = new EmailTrack;
        $isOpen->isOpen($_GET['trackCode']);
        
    }
?>