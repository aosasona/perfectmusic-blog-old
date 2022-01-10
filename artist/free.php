<?php
session_start();

include("../connect.php");

include("validate.php");

if(isset($_POST["fetch"])) {

//Upload Variable Declaration
$artname = strtolower($_SESSION["name"]);
$name = $_POST["name"];
$title = addslashes($name);
$about = $_POST["about"];
$about = addslashes($about);
$about = htmlspecialchars($about);
$feature = $_POST["feature"];
$feature = addslashes($feature);
$audiomack = $_POST["audiomack"];
date_default_timezone_set("Africa/Lagos");
$date = date('M d, Y');


//Image variable declaration for thumbnail
$dir = "../images/";
$file = $dir.basename($_FILES["thumb"]["name"]);
$uploadfilevalue = 1;
$filetype = pathinfo($file.PATHINFO_EXTENSION);
$lin = "https://perfectmusic.com.ng/images/".$_FILES["thumb"]["name"];
$image_name = $_FILES["thumb"]["name"];

//Upload file
move_uploaded_file($_FILES["thumb"]["tmp_name"], $file);


//Image variable declaration for file upload
$dir = "../upload/";
$file = $dir.basename($_FILES["photo"]["name"]);
$uploadfilevalue = 1;
$filetype = pathinfo($file.PATHINFO_EXTENSION);
$link = "https://perfectmusic.com.ng/upload/".$_FILES["photo"]["name"];
$image_name = $_FILES["photo"]["name"];

//Upload file
move_uploaded_file($_FILES["photo"]["tmp_name"], $file);

//Insert data into database
$insert = "INSERT INTO music_upload (name, link, thumb, about, main, feature, downloads, updated, audiomack, music_type, author, premium, visible) 
VALUES('$title', '$link', '$lin', '$about', '$artname', '$feature', '0', '$date', '$audiomack', ' ', '$artname', 'NO', 'ON')";

mysql_query($insert);

echo '<meta http-equiv="refresh" content="0, url=/artist/dashboard.php#release">';

}
?>