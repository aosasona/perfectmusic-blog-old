<?php

//Fetch today's date
date_default_timezone_set("Africa/Lagos");
$date = date('d-m-Y');

$sql = "SELECT * FROM sub_history WHERE sub_end='$date' AND validity='ACTIVE' ORDER BY id DESC";
$run = mysql_query($sql);
$count = mysql_num_rows($run);

if($count > 0){

while($sub = mysql_fetch_array($run)){
    $username = $sub["username"];
    $id = $sub["id"];
//CHANGE ACCOUNT STATUS TO INACTIVE
$update = "UPDATE artist_profile SET sub_status='INACTIVE' WHERE username='$username'";
mysql_query($update) OR die(mysql_error());

//CHANGE SUB STATUS TO EXPIRED
$update = "UPDATE sub_history SET validity='EXPIRED' WHERE id='$id'";
mysql_query($update) OR die(mysql_error());

//CHANGE ALL ARTISTE'S SONGS TO HIDDEN

$sqlr = "SELECT * FROM artist_profile WHERE username='$username'";
$runr = mysql_query($sqlr);

while($pick = mysql_fetch_array($runr)){
    $name = $pick["name"];

    $update_song = "UPDATE music_upload SET visible='OFF' WHERE main='$name'";
    mysql_query($update_song) OR die(mysql_error());
}
}
}
?>