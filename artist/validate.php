<?php
$username = $_SESSION["username"];
$sql = "SELECT * FROM artist_profile WHERE username='$username'";
$run = mysql_query($sql) or die(mysql_error());

while($profile = mysql_fetch_array($run)){
    $status = $profile["sub_status"];
}

function validate() {
    if(isset($_SESSION["username"])){
        return true;
    } else {
        return false;
    }
}

function payment() {
    if($status != "INACTIVE"){
        return true;
    }
    else {
        return false;
    }
}

if(!validate()){
    echo '<meta http-equiv="refresh" content="0, url=/artist/signin">';
}

if(!payment()){
    echo '<meta http-equiv="refresh" content="0, url=/artist/signup/plan.php">';
}
?>