<?php

function validate() {
    if(isset($_SESSION["customer"])){
        return true;
    }
    else {
        return false;
    }
}

if(!validate()){
    echo '<meta http-equiv="refresh" content="0, url=/premium/signin">';
}