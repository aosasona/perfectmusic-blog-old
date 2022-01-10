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
*{ 
  padding: 0px;
  font-family : arial;
}
.sect {
    background : #333333;
    color : orange;
    width : 96%;
    height : auto;
    padding-bottom : 10px;
    border : none;
    border-radius : 10px;
    margin-bottom : 4%;
    text-align : left;
}
.button {
    color : white;
    background : orange;
    border : none;
    width : auto;
    height : auto;
    padding : 14px;
    margin-bottom : 10px;
    -webkit-appearance: none;
}
.top {
    background : orange;
    color : black;
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
    width : 50%;
    height : auto;
    padding : 8px;
    border : 2px solid orange;
    margin-top : 2px;
    margin-bottom : 5px;
}
.field2 input {
    width : 80%;
    height : auto;
    padding : 8px;
    border : 2px solid orange;
    margin-top : 2px;
    margin-bottom : 5px;
}
.right a {
    text-align : right;
    color : red;
}
.sect a {
    color : red;
    text-align : right;
    float : right;
    font-size : 80%;
    text-decoration : none;
}
.delshow {
    padding : 5px;
    border-bottom : 2px solid white;
    border-right : none;
    border-left : none;
    border-top : none;
    height : auto;
    width : auto;
    font-size : 110%;
}
a {
    color : orange;
    text-decoration : none;
}
.other {
    margin-top : 5px;
    margin-bottom : 10px;
    padding : 2px;
}
.other a {
    background : #222222;
    width : auto;
    height : auto;
    border-radius : 25px;
    padding : 10px;
    float : left;
    display : inline;
    margin-left : 6px;
    margin-bottom : 6px;

}
textarea {
    width : 95%;
    height : 30%;
}
</style>

</head>

<title>Admin Area - Perfect Music Control Panel</title>
<body>

<h2>ADMIN TOOLS</h2>
</br>
<?php
echo 'Your current IP address : '.$_SERVER['REMOTE_ADDR'];
?>

</br></br>
<center>
<div class="sect">
<div class="top"><center><h2>File Upload Center</h2></center></div>
</br>
<div class="type">
If your file is large, please be patient with the upload process and ensure you have a strong network connection!
</br>

<form action="/admin/fetch.php" method = "POST" enctype="multipart/form-data">
</br></br>


<div class="field2">
<b>Title/Song's Name</b></br>
    <input type="text" name="name" placeholder="Title" required="required"/>
</div>
</br></br>
<div class="field">
<b>Main Artist (ONE, REQUIRED)</b></br>
    <input type="text" name="artist" placeholder="Main artist..." />
</div>
</br></br>
<div class="field2">
<b>Artists Featured</b></br>
    <input type="text" name="feature" placeholder="Featuring..."/>
</div>

</br></br>
<div class="field2">
<b>Audiomack Link</b></br>
    <input type="text" name="audiomack" placeholder="Audiomack Link"/>
</div>

</br></br>
<div class="field2">
<b>Video Link</b></br>
    <input type="text" name="video_link" placeholder="Video Link(For EXTERNAL Uploads)"/>
</div>

</br></br>
<b>Select Upload Type : </b></br></br>

<input type="radio" name="type" value="music" required="required"/> <b>Music file</b> </br>
<input type="radio" name="type" value="video" required="required"/> <b>Video file</b> </br>
<input type="radio" name="type" value="news" required="required"/> <b>News Update</b> </br>
<input type="radio" name="type" value="talk-zone" required="required"/> <b>Talk Zone</b> </br>
<input type="radio" name="type" value="sports" required="required"/> <b>Sports</b> </br>
<input type="radio" name="type" value="pm-list" required="required"/> <b>PM List Article</b> </br>
<input type="radio" name="type" value="mix" required="required"/> <b>Mixtape</b> </br>
<input type="radio" name="type" value="file" required="required"/> <b>Other Files... </b> </br>

</br></br>

<textarea name="about" required="required" Placeholder="Description/Article"></textarea>
</br></br></br>

<b>Select the thumbnail/music art/image</b> : 
<input type="file" name="thumb" id="thumb"/></br>
</br></br>

<b>Select the MAIN image/file you want to upload</b> : 
<input type="file" name="photo" id="photo"/></br>
</br></br>

<b>Select the 2ND image/file you want to upload</b> : 
<input type="file" name="photo2" id="photo"/></br>
</br></br>

<b>Select the 3RD image/file you want to upload</b> : 
<input type="file" name="photo3" id="photo"/></br>
</br></br>

<b>Select the 4TH image/file you want to upload</b> : 
<input type="file" name="photo4" id="photo"/></br>
</br></br>


<input type="submit" name="fetch" class="button" value="Upload"/>
</div>
</div>

</center>

<h1>OTHER TOOLS</h1>
<b>
<div class="other">
<a href="/admin/account.php">Editors' Accounts</a>
<a href="/admin/mixtape.php">Mixtapes</a>
<a href="/admin/music.php">Songs</a>
<a href="/admin/videos.php">Videos</a>
<a href="/admin/news.php">News Articles</a>
<a href="/admin/files.php">Files</a>
<a href="/admin/sports.php">Sports</a>
<a href="/admin/talk-zone.php">Talk Zone</a>
<a href="/admin/pm-list.php">PM List</a>
<a href="/admin/ads.php">Manage Ads</a>
<a href="/admin/mail.php">Mailing List</a>
<a href="/admin/giveaway.php">Manage Giveaways</a>
<a href="/admin/artists.php">Manage Top Artistes</a>
<a href="/admin/code.php">Manage eCodes</a>
<a href="/admin/withdraw.php">Manage Withdrawals</a>


</div>
</b>


</body>
</html>