<?php
error_reporting(-1);

include("../connect.php");
session_start();

$id = $_SESSION["id"];

if(isset($_POST["yes"])){
$sql = "DELETE FROM music_upload WHERE id='$id'";
mysql_query($sql);

echo '<meta http-equiv="refresh" content="0, url=/artist/dashboard.php#release">';
}
if(isset($_POST["no"])){
    echo '<meta http-equiv="refresh" content="0, url=/artist/dashboard.php#release">';
}

?>