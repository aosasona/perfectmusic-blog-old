<?php        
        //Lower case everything
        $title = strtolower($title);
        //Make alphanumeric (removes all other characters)
        $title = preg_replace("/[^a-z0-9_\s-]/", "", $title);
        //Clean up multiple dashes or whitespaces
        $title = preg_replace("/[\s-]+/", " ", $title);
        //Convert whitespaces and underscore to dash
        $title = preg_replace("/[\s_]/", "-", $title);
        //Remove other characters except the first 20
        $title = substr($title,0,60);
?>