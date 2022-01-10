<?php
session_start();
include("../connect.php");
include("../header.php");

error_reporting(-1);

function editor() {
    if(isset($_SESSION["editor"])){
        return true;
    }else{
        return false;
    }
}
if(!editor()){
  echo '<meta http-equiv="refresh" content="0, url=/editor/">';
}
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>

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
.topm {
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

<title>Admin Area - Upload Sucessful</title>
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
$username = $_SESSION["editor"];
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


if($type == "music") {
    
//Insert data into database
$insert = "INSERT INTO music_upload (name, link, thumb, about, main, feature, downloads, updated, audiomack, music_type, author, premium, visible)
VALUES('$title', '$link', '$lin', '$about', '$artist', '$feature', '0', '$date', '$audiomack', ' ', '$username', 'NO', 'ON')";

mysql_query($insert);

}

//IF IT IS A MIXTAPE
if($type == "mix") {
    
    //Insert data into database
    $insert = "INSERT INTO music_upload (name, link, thumb, about, main, feature, downloads, updated, audiomack, music_type, author, premium, visible) 
    VALUES('$title', '$link', '$lin', '$about', '$artist', '$feature', '0', '$date', '$audiomack', 'mix', '$username', 'NO', 'ON')";
    
    mysql_query($insert);
    }

if($type == "video") {

    if($link == "https://perfectmusic.com.ng/upload/"){
        $link = $_POST["video_link"];
        }
else {
    //Insert data into database
    $insert = "INSERT INTO video_upload (name, link, about, downloads, updated, author) 
    VALUES('$title', '$link', '$about', '0', '$date' '$username')";
}

mysql_query($insert);
}

if($type == "file") {
    //Insert data into database
    $insert = "INSERT INTO files (name, link, thumb, about, downloads, updated, author) 
    VALUES('$title', '$link', '$lin', '$about', '0', '$date', '$username')";
    
    mysql_query($insert);
}

//if type is news

if($type == "news") {

//Image variable declaration for second image upload
$dir2 = "../upload/";
$file2 = $dir2.basename($_FILES["photo2"]["name"]);
$uploadfilevalue = 1;
$filetype = pathinfo($file2.PATHINFO_EXTENSION);
$thumb2 = "https://perfectmusic.com.ng/upload/".$_FILES["photo2"]["name"];
$image_name = $_FILES["photo2"]["name"];

//Upload image 2
move_uploaded_file($_FILES["photo2"]["tmp_name"], $file2);
 

//Image variable declaration for third image upload
$dir3 = "../upload/";
$file3 = $dir3.basename($_FILES["photo3"]["name"]);
$uploadfilevalue = 1;
$filetype = pathinfo($file3.PATHINFO_EXTENSION);
$thumb3 = "https://perfectmusic.com.ng/upload/".$_FILES["photo3"]["name"];
$image_name = $_FILES["photo3"]["name"];

//Upload image 3
move_uploaded_file($_FILES["photo3"]["tmp_name"], $file3);


//Image variable declaration for fourth image upload
$dir4 = "../upload/";
$file4 = $dir4.basename($_FILES["photo4"]["name"]);
$uploadfilevalue = 1;
$filetype = pathinfo($file4.PATHINFO_EXTENSION);
$thumb4 = "https://perfectmusic.com.ng/upload/".$_FILES["photo4"]["name"];
$image_name = $_FILES["photo4"]["name"];

//Upload image 4
move_uploaded_file($_FILES["photo4"]["tmp_name"], $file4);

//Insert data into database
    $insert = "INSERT INTO news (name, thumb, article, views, likes, dislikes, updated, thumb2, thumb3, thumb4, article_type, author, thumb5)
    VALUES('$title', '$lin', '$about', '0', '0', '0', '$date', '$link', '$thumb2', '$thumb3', ' ', '$username', '$thumb4')";
    
    mysql_query($insert);
}


   

//IF IT IS A TALK ZONE POST
if($type == "talk-zone") {

    //Image variable declaration for second image upload
    $dir2 = "../upload/";
    $file2 = $dir2.basename($_FILES["photo2"]["name"]);
    $uploadfilevalue = 1;
    $filetype = pathinfo($file2.PATHINFO_EXTENSION);
    $thumb2 = "https://perfectmusic.com.ng/upload/".$_FILES["photo2"]["name"];
    $image_name = $_FILES["photo2"]["name"];
    
    //Upload image 2
    move_uploaded_file($_FILES["photo2"]["tmp_name"], $file2);
     
    
    //Image variable declaration for third image upload
    $dir3 = "../upload/";
    $file3 = $dir3.basename($_FILES["photo3"]["name"]);
    $uploadfilevalue = 1;
    $filetype = pathinfo($file3.PATHINFO_EXTENSION);
    $thumb3 = "https://perfectmusic.com.ng/upload/".$_FILES["photo3"]["name"];
    $image_name = $_FILES["photo3"]["name"];
    
    //Upload image 3
    move_uploaded_file($_FILES["photo3"]["tmp_name"], $file3);
    
    
    //Image variable declaration for fourth image upload
    $dir4 = "../upload/";
    $file4 = $dir4.basename($_FILES["photo4"]["name"]);
    $uploadfilevalue = 1;
    $filetype = pathinfo($file4.PATHINFO_EXTENSION);
    $thumb4 = "https://perfectmusic.com.ng/upload/".$_FILES["photo4"]["name"];
    $image_name = $_FILES["photo4"]["name"];
    
    //Upload image 4
    move_uploaded_file($_FILES["photo4"]["tmp_name"], $file4);
    
    //Insert data into database
        $insert = "INSERT INTO news (name, thumb, article, views, likes, dislikes, updated, thumb2, thumb3, thumb4, article_type, author, thumb5)  
        VALUES('$title', '$lin', '$about', '0', '0', '0', '$date', '$link', '$thumb2', '$thumb3', 'talk-zone', '$username', '$thumb4')";
        
        mysql_query($insert);
    }
    
    
       

//IF IT IS A SPORTS POST
if($type == "sports") {

    //Image variable declaration for second image upload
    $dir2 = "../upload/";
    $file2 = $dir2.basename($_FILES["photo2"]["name"]);
    $uploadfilevalue = 1;
    $filetype = pathinfo($file2.PATHINFO_EXTENSION);
    $thumb2 = "https://perfectmusic.com.ng/upload/".$_FILES["photo2"]["name"];
    $image_name = $_FILES["photo2"]["name"];
    
    //Upload image 2
    move_uploaded_file($_FILES["photo2"]["tmp_name"], $file2);
     
    
    //Image variable declaration for third image upload
    $dir3 = "../upload/";
    $file3 = $dir3.basename($_FILES["photo3"]["name"]);
    $uploadfilevalue = 1;
    $filetype = pathinfo($file3.PATHINFO_EXTENSION);
    $thumb3 = "https://perfectmusic.com.ng/upload/".$_FILES["photo3"]["name"];
    $image_name = $_FILES["photo3"]["name"];
    
    //Upload image 3
    move_uploaded_file($_FILES["photo3"]["tmp_name"], $file3);
    
    
    //Image variable declaration for fourth image upload
    $dir4 = "../upload/";
    $file4 = $dir4.basename($_FILES["photo4"]["name"]);
    $uploadfilevalue = 1;
    $filetype = pathinfo($file4.PATHINFO_EXTENSION);
    $thumb4 = "https://perfectmusic.com.ng/upload/".$_FILES["photo4"]["name"];
    $image_name = $_FILES["photo4"]["name"];
    
    //Upload image 4
    move_uploaded_file($_FILES["photo4"]["tmp_name"], $file4);
    
    //Insert data into database
        $insert = "INSERT INTO news (name, thumb, article, views, likes, dislikes, updated, thumb2, thumb3, thumb4, article_type, author, thumb5)  
        VALUES('$title', '$lin', '$about', '0', '0', '0', '$date', '$link', '$thumb2', '$thumb3', 'sports', '$username', '$thumb4')";
        
        mysql_query($insert);
    }
    
   
       

//IF IT IS A PM-LIST POST
if($type == "pm-list") {

    //Image variable declaration for second image upload
    $dir2 = "../upload/";
    $file2 = $dir2.basename($_FILES["photo2"]["name"]);
    $uploadfilevalue = 1;
    $filetype = pathinfo($file2.PATHINFO_EXTENSION);
    $thumb2 = "https://perfectmusic.com.ng/upload/".$_FILES["photo2"]["name"];
    $image_name = $_FILES["photo2"]["name"];
    
    //Upload image 2
    move_uploaded_file($_FILES["photo2"]["tmp_name"], $file2);
     
    
    //Image variable declaration for third image upload
    $dir3 = "../upload/";
    $file3 = $dir3.basename($_FILES["photo3"]["name"]);
    $uploadfilevalue = 1;
    $filetype = pathinfo($file3.PATHINFO_EXTENSION);
    $thumb3 = "https://perfectmusic.com.ng/upload/".$_FILES["photo3"]["name"];
    $image_name = $_FILES["photo3"]["name"];
    
    //Upload image 3
    move_uploaded_file($_FILES["photo3"]["tmp_name"], $file3);
    
    
    //Image variable declaration for fourth image upload
    $dir4 = "../upload/";
    $file4 = $dir4.basename($_FILES["photo4"]["name"]);
    $uploadfilevalue = 1;
    $filetype = pathinfo($file4.PATHINFO_EXTENSION);
    $thumb4 = "https://perfectmusic.com.ng/upload/".$_FILES["photo4"]["name"];
    $image_name = $_FILES["photo4"]["name"];
    
    //Upload image 4
    move_uploaded_file($_FILES["photo4"]["tmp_name"], $file4);
    
    //Insert data into database
        $insert = "INSERT INTO news (name, thumb, article, views, likes, dislikes, updated, thumb2, thumb3, thumb4, article_type, author, thumb5) 
        VALUES('$title', '$lin', '$about', '0', '0', '0', '$date', '$link', '$thumb2', '$thumb3', 'pm-list', '$username', '$thumb4')";

    mysql_query($insert);
        
    }
    
    echo '<meta http-equiv="refresh" content="0, url=/editor/main.php">';
       
    }

?>

<center>
</br></br>
    <font color="orange">
        <img src="../images/tick.png" width="200px" height="200px"/></br></br>
        <b><h3>UPLOAD SUCCESSFUL!!</h2></b>
</font>
</br></br></br>
<a href="https://perfectmusic.com.ng/editor">Go back to <b>Home</b> page</a>
</center>

</html>
<?php
echo "</br></br>";
include("../footer.php");
?>