<?php
session_start();
include("../connect.php");
include("../header.php");

error_reporting(-1);

function logged() {
    if(isset($_SESSION["log"])){
        return true;
    }else{
        return false;
    }
}
if(!logged()){
  echo '<meta http-equiv="refresh" content="0, url=/admin/login.php">';
}
?>

<html>
<head>
<link rel="stylesheet" href="../stylesheet.css" type="text/css"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="../images/favicon.png">

<style>
body
{ 
  padding: 30px 
}
.sect {
    background : #333333;
    color : orange;
    width : 96%;
    height : auto;
    padding-bottom : 10px;
    border : none;
    border-radius : 10px;
}
.button {
    color : white;
    background : orange;
    border : none;
    width : auto;
    height : auto;
    padding : 10px;
    margin-bottom : 10px;
}
.top {
    background : black;
    height : auto;
    width : auto;
    padding : 6px;
    border-radius : 10px 10px 0px 0px;
}
.type {
    margin-left : 12px;
    margin-right : 12px;
}
.field input {
    width : auto;
    height : auto;
    padding : 8px;
    border : 2px solid orange;
    margin-top : 40px;
}
a {
    color : orange;
}
</style>

</head>

<title>Admin Area - File Added Sucessfully</title>
<body>

<?php

if(isset($_POST["fetch"])) {

//Upload Variable Declaration
$name = $_POST["name"];
$title = addslashes($name);
$type = $_POST["type"];
$about = $_POST["about"];
$about = addslashes($about);
$about = htmlspecialchars($about);
$art = $_POST["artist"];
$artist = StrToLower($art);
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
$lin = "https://godaddypmusic.com/images/".$_FILES["thumb"]["name"];
$image_name = $_FILES["thumb"]["name"];

//Upload file
move_uploaded_file($_FILES["thumb"]["tmp_name"], $file);


//Image variable declaration for file upload
$dir = "../upload/";
$file = $dir.basename($_FILES["photo"]["name"]);
$uploadfilevalue = 1;
$filetype = pathinfo($file.PATHINFO_EXTENSION);
$link = "https://godaddypmusic.com/upload/".$_FILES["photo"]["name"];
$image_name = $_FILES["photo"]["name"];

//Upload file
move_uploaded_file($_FILES["photo"]["tmp_name"], $file);


if($type == "music") {
    
//Insert data into database
$insert = "INSERT INTO music_upload (name, link, thumb, about, main, feature, downloads, updated, audiomack, music_type, author, premium, visible) 
VALUES('$title', '$link', '$lin', '$about', '$artist', '$feature', '0', '$date', '$audiomack', ' ', ' ', 'NO', 'ON')";

}

//IF IT IS A MIXTAPE
if($type == "mix") {
    
    //Insert data into database
    $insert = "INSERT INTO music_upload (name, link, thumb, about, main, feature, downloads, updated, audiomack, music_type, author, premium, visible) 
    VALUES('$title', '$link', '$lin', '$about', '$artist', '$feature', '0', '$date', '$audiomack', 'mix', ' ', 'NO', 'ON')";
    
}

if($type == "video") {

    if($link == "https://godaddypmusic.com/upload/"){
        $link = $_POST["video_link"];
        }
else {
    //Insert data into database
    $insert = "INSERT INTO video_upload (name, link, about, downloads, updated) 
    VALUES('$title', '$link', '$about', '0', '$date')";
}
}

if($type == "file") {
    //Insert data into database
    $insert = "INSERT INTO files (name, link, thumb, about, downloads, updated) 
    VALUES('$title', '$link', '$lin', '$about', '0', '$date')";
    
}

//if type is news

if($type == "news") {

//Image variable declaration for second image upload
$dir2 = "../upload/";
$file2 = $dir2.basename($_FILES["photo2"]["name"]);
$uploadfilevalue = 1;
$filetype = pathinfo($file2.PATHINFO_EXTENSION);
$thumb2 = "https://godaddypmusic.com/upload/".$_FILES["photo2"]["name"];
$image_name = $_FILES["photo2"]["name"];

//Upload image 2
move_uploaded_file($_FILES["photo2"]["tmp_name"], $file2);
 

//Image variable declaration for third image upload
$dir3 = "../upload/";
$file3 = $dir3.basename($_FILES["photo3"]["name"]);
$uploadfilevalue = 1;
$filetype = pathinfo($file3.PATHINFO_EXTENSION);
$thumb3 = "https://godaddypmusic.com/upload/".$_FILES["photo3"]["name"];
$image_name = $_FILES["photo3"]["name"];

//Upload image 3
move_uploaded_file($_FILES["photo3"]["tmp_name"], $file3);


//Image variable declaration for fourth image upload
$dir4 = "../upload/";
$file4 = $dir4.basename($_FILES["photo4"]["name"]);
$uploadfilevalue = 1;
$filetype = pathinfo($file4.PATHINFO_EXTENSION);
$thumb4 = "https://godaddypmusic.com/upload/".$_FILES["photo4"]["name"];
$image_name = $_FILES["photo4"]["name"];

//Upload image 4
move_uploaded_file($_FILES["photo4"]["tmp_name"], $file4);

//Insert data into database
    $insert = "INSERT INTO news (name, thumb, article, views, likes, dislikes, updated, thumb2, thumb3, thumb4, article_type) 
    VALUES('$title', '$lin', '$about', '0', '0', '0', '$date', '$thumb2', '$thumb3', '$thumb4', ' ')";
    
}

   

//IF IT IS A TALK ZONE POST
if($type == "talk-zone") {

    //Image variable declaration for second image upload
    $dir2 = "../upload/";
    $file2 = $dir2.basename($_FILES["photo2"]["name"]);
    $uploadfilevalue = 1;
    $filetype = pathinfo($file2.PATHINFO_EXTENSION);
    $thumb2 = "https://godaddypmusic.com/upload/".$_FILES["photo2"]["name"];
    $image_name = $_FILES["photo2"]["name"];
    
    //Upload image 2
    move_uploaded_file($_FILES["photo2"]["tmp_name"], $file2);
     
    
    //Image variable declaration for third image upload
    $dir3 = "../upload/";
    $file3 = $dir3.basename($_FILES["photo3"]["name"]);
    $uploadfilevalue = 1;
    $filetype = pathinfo($file3.PATHINFO_EXTENSION);
    $thumb3 = "https://godaddypmusic.com/upload/".$_FILES["photo3"]["name"];
    $image_name = $_FILES["photo3"]["name"];
    
    //Upload image 3
    move_uploaded_file($_FILES["photo3"]["tmp_name"], $file3);
    
    
    //Image variable declaration for fourth image upload
    $dir4 = "../upload/";
    $file4 = $dir4.basename($_FILES["photo4"]["name"]);
    $uploadfilevalue = 1;
    $filetype = pathinfo($file4.PATHINFO_EXTENSION);
    $thumb4 = "https://godaddypmusic.com/upload/".$_FILES["photo4"]["name"];
    $image_name = $_FILES["photo4"]["name"];
    
    //Upload image 4
    move_uploaded_file($_FILES["photo4"]["tmp_name"], $file4);
    
    //Insert data into database
        $insert = "INSERT INTO news (name, thumb, article, views, likes, dislikes, updated, thumb2, thumb3, thumb4, article_type) 
        VALUES('$title', '$lin', '$about', '0', '0', '0', '$date', '$thumb2', '$thumb3', '$thumb4', 'talk-zone')";
        
    }
       


//IF IT IS A SPORTS POST
if($type == "sports") {

    //Image variable declaration for second image upload
    $dir2 = "../upload/";
    $file2 = $dir2.basename($_FILES["photo2"]["name"]);
    $uploadfilevalue = 1;
    $filetype = pathinfo($file2.PATHINFO_EXTENSION);
    $thumb2 = "https://godaddypmusic.com/upload/".$_FILES["photo2"]["name"];
    $image_name = $_FILES["photo2"]["name"];
    
    //Upload image 2
    move_uploaded_file($_FILES["photo2"]["tmp_name"], $file2);
     
    
    //Image variable declaration for third image upload
    $dir3 = "../upload/";
    $file3 = $dir3.basename($_FILES["photo3"]["name"]);
    $uploadfilevalue = 1;
    $filetype = pathinfo($file3.PATHINFO_EXTENSION);
    $thumb3 = "https://godaddypmusic.com/upload/".$_FILES["photo3"]["name"];
    $image_name = $_FILES["photo3"]["name"];
    
    //Upload image 3
    move_uploaded_file($_FILES["photo3"]["tmp_name"], $file3);
    
    
    //Image variable declaration for fourth image upload
    $dir4 = "../upload/";
    $file4 = $dir4.basename($_FILES["photo4"]["name"]);
    $uploadfilevalue = 1;
    $filetype = pathinfo($file4.PATHINFO_EXTENSION);
    $thumb4 = "https://godaddypmusic.com/upload/".$_FILES["photo4"]["name"];
    $image_name = $_FILES["photo4"]["name"];
    
    //Upload image 4
    move_uploaded_file($_FILES["photo4"]["tmp_name"], $file4);
    
    //Insert data into database
        $insert = "INSERT INTO news (name, thumb, article, views, likes, dislikes, updated, thumb2, thumb3, thumb4, article_type) 
        VALUES('$title', '$lin', '$about', '0', '0', '0', '$date', '$thumb2', '$thumb3', '$thumb4', 'sports')";
        
    }
    

//IF IT IS A PM-LIST POST
if($type == "pm-list") {

    //Image variable declaration for second image upload
    $dir2 = "../upload/";
    $file2 = $dir2.basename($_FILES["photo2"]["name"]);
    $uploadfilevalue = 1;
    $filetype = pathinfo($file2.PATHINFO_EXTENSION);
    $thumb2 = "https://godaddypmusic.com/upload/".$_FILES["photo2"]["name"];
    $image_name = $_FILES["photo2"]["name"];
    
    //Upload image 2
    move_uploaded_file($_FILES["photo2"]["tmp_name"], $file2);
     
    
    //Image variable declaration for third image upload
    $dir3 = "../upload/";
    $file3 = $dir3.basename($_FILES["photo3"]["name"]);
    $uploadfilevalue = 1;
    $filetype = pathinfo($file3.PATHINFO_EXTENSION);
    $thumb3 = "https://godaddypmusic.com/upload/".$_FILES["photo3"]["name"];
    $image_name = $_FILES["photo3"]["name"];
    
    //Upload image 3
    move_uploaded_file($_FILES["photo3"]["tmp_name"], $file3);
    
    
    //Image variable declaration for fourth image upload
    $dir4 = "../upload/";
    $file4 = $dir4.basename($_FILES["photo4"]["name"]);
    $uploadfilevalue = 1;
    $filetype = pathinfo($file4.PATHINFO_EXTENSION);
    $thumb4 = "https://godaddypmusic.com/upload/".$_FILES["photo4"]["name"];
    $image_name = $_FILES["photo4"]["name"];
    
    //Upload image 4
    move_uploaded_file($_FILES["photo4"]["tmp_name"], $file4);
    
    //Insert data into database
        $insert = "INSERT INTO news (name, thumb, article, views, likes, dislikes, updated, thumb2, thumb3, thumb4, article_type) 
        VALUES('$title', '$lin', '$about', '0', '0', '0', '$date', '$thumb2', '$thumb3', '$thumb4', 'pm-list')";
        
    }
    
    mysql_query($insert);
       
    }

?>

<center>
</br></br>
    <font color="orange">
        <img src="../images/tick.png" width="200px" height="200px"/></br></br>
        <b><h2>UPLOAD SUCCESSFUL!!</h2></b>
</font>
</br></br></br>
<a href="https://perfectmusic.com.ng">Go back to <b>Home</b> page</a>
</center>

</html>