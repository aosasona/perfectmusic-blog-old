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
  font-family : Arial, Helvetica, sans-serif;
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
}
.top {
    background : orange;
    color : black;
    height : auto;
    width : auto;
    padding : 10px;
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
select{
    appearance : none;
    outline : 0;
    background : white;
    width : 38%;
    height : auto;
    color : black;
    cursor : pointer;
    border : none;
    border-radius : 10px;
    margin-bottom : 2%;
    padding : 12px;
}

.select{
    position : relative;
    display : block;
}
</style>

</head>

<title>Admin Area - Artistes Management Tool</title>
<body>

<h2>ADMIN TOOLS</h2>
</br>
<?php
echo 'Your current IP address : '.$_SERVER['REMOTE_ADDR'];
?>

</br></br>
<center>
<div class="sect">
<div class="top"><center><h2>Add A New Artist</h2></center></div>
</br>
<div class="type">
    
<form action="/admin/artists.php" method = "POST" enctype="multipart/form-data">
</br>

<div class="field">
<input type="text" name="artist" placeholder="Enter Artist's Name Here..." required="required"/>
</div>

</br>
Select Artist's image : 
<input type="file" name="thumb" required="required"/>
</br></br>

<input type="submit" name="addnew" value="+ Add Artist" class="button"/>
</br></br>
</form>

<?php

if(isset($_POST["addnew"])) {


//Upload Variable Declaration
$name = $_POST["artist"];
$name = StrToLower($name);
date_default_timezone_set("Africa/Lagos");
$date = date('M d, Y');

$see = "SELECT * FROM artist WHERE name='$name'";
$rev = mysql_query($see);
$cunt = mysql_num_rows($rev);

if($cunt < 1){

//Image variable declaration for thumbnail
$dir = "../images/";
$file = $dir.basename($_FILES["thumb"]["name"]);
$uploadfilevalue = 1;
$filetype = pathinfo($file.PATHINFO_EXTENSION);
$lin = "https://godaddypmusic.com/images/".$_FILES["thumb"]["name"];
$image_name = $_FILES["thumb"]["name"];

//Upload file
move_uploaded_file($_FILES["thumb"]["tmp_name"], $file);

//Check if the user is a subscribed user/artiste
$ve = "SELECT * FROM artist_profile WHERE name='$name'";
$re = mysql_query($ve);

if(mysql_num_rows($re) > 0){
    $ver = "YES";
}else {
    $ver = "NO";
}

//Insert data into database
$insert = "INSERT INTO artist (name, photo, position, updated, verify) 
VALUES('$name', '$lin', '0', '$date', '$ver')";

mysql_query($insert);

echo "<b>REPORT : Artist added successfully</b>";
}
else {
    echo "<b>REPORT : Artist already exists in DB</b>";
}
echo '<meta http-equiv="refresh" content="3, url=/admin/artists.php">';
}
?>
</br>
</div></div>


</br></br>
<center>
<div class="sect">
<div class="top"><center><h2>Select Top 3 Artistes</h2></center></div>
</br>
<div class="type">

<form action="artists.php" method="POST">
</br></br>

<b>ARTIST 1</b></br>
<div class="select">
    <select name="top1" required="required">
<?php 
$sq = "SELECT * FROM artist ORDER BY 'name' ASC";
$query = mysql_query($sq);

while($show = mysql_fetch_array($query)){
    $art = $show["name"];
    $artistcap = StrToLower($art);
    $artistsmall = StrToUpper($art);
?>

    <option value=<?php echo '"'.$artistcap.'"'; ?>><?php echo '<b>'.$artistsmall.'</b>'; ?>

<?php
}
?>
</select>

</br></br>

<b>ARTIST 2</b></br>
<div class="select">
    <select name="top2" required="required">
<?php 
$sq = "SELECT * FROM artist ORDER BY 'name' ASC";
$query = mysql_query($sq);

while($show = mysql_fetch_array($query)){
    $art = $show["name"];
    $artistcap = StrToLower($art);
    $artistsmall = StrToUpper($art);
?>

    <option value=<?php echo '"'.$artistcap.'"'; ?>><?php echo '<b>'.$artistsmall.'</b>'; ?>

<?php
}
?>
</select>

</br></br>

<b>ARTIST 3</b></br>
<div class="select">
    <select name="top3" required="required">
<?php 
$sq = "SELECT * FROM artist ORDER BY 'name' ASC";
$query = mysql_query($sq);

while($show = mysql_fetch_array($query)){
    $art = $show["name"];
    $artistcap = StrToLower($art);
    $artistsmall = StrToUpper($art);
?>

    <option value=<?php echo '"'.$artistcap.'"'; ?>><?php echo '<b>'.$artistsmall.'</b>'; ?>

<?php
}
?>
</select>

</br></br>

<b>ARTIST 4</b></br>
<div class="select">
    <select name="top4" required="required">
<?php 
$sq = "SELECT * FROM artist ORDER BY 'name' ASC";
$query = mysql_query($sq);

while($show = mysql_fetch_array($query)){
    $art = $show["name"];
    $artistcap = StrToLower($art);
    $artistsmall = StrToUpper($art);
?>

    <option value=<?php echo '"'.$artistcap.'"'; ?>><?php echo '<b>'.$artistsmall.'</b>'; ?>

<?php
}
?>
</select>

</br></br>

<b>ARTIST 5</b></br>
<div class="select">
    <select name="top5" required="required">
<?php 
$sq = "SELECT * FROM artist ORDER BY 'name' ASC";
$query = mysql_query($sq);

while($show = mysql_fetch_array($query)){
    $art = $show["name"];
    $artistcap = StrToLower($art);
    $artistsmall = StrToUpper($art);
?>

    <option value=<?php echo '"'.$artistcap.'"'; ?>><?php echo '<b>'.$artistsmall.'</b>'; ?>

<?php
}
?>
</select>

</br></br>

<b>ARTIST 6</b></br>
<div class="select">
    <select name="top6" required="required">
<?php 
$sq = "SELECT * FROM artist ORDER BY 'name' ASC";
$query = mysql_query($sq);

while($show = mysql_fetch_array($query)){
    $art = $show["name"];
    $artistcap = StrToLower($art);
    $artistsmall = StrToUpper($art);
?>

    <option value=<?php echo '"'.$artistcap.'"'; ?>><?php echo '<b>'.$artistsmall.'</b>'; ?>

<?php
}
?>
</select>

</br></br>

<b>ARTIST 7</b></br>
<div class="select">
    <select name="top7" required="required">
<?php 
$sq = "SELECT * FROM artist ORDER BY 'name' ASC";
$query = mysql_query($sq);

while($show = mysql_fetch_array($query)){
    $art = $show["name"];
    $artistcap = StrToLower($art);
    $artistsmall = StrToUpper($art);
?>

    <option value=<?php echo '"'.$artistcap.'"'; ?>><?php echo '<b>'.$artistsmall.'</b>'; ?>

<?php
}
?>
</select>

</br></br>

<b>ARTIST 8</b></br>
<div class="select">
    <select name="top8" required="required">
<?php 
$sq = "SELECT * FROM artist ORDER BY 'name' ASC";
$query = mysql_query($sq);

while($show = mysql_fetch_array($query)){
    $art = $show["name"];
    $artistcap = StrToLower($art);
    $artistsmall = StrToUpper($art);
?>

    <option value=<?php echo '"'.$artistcap.'"'; ?>><?php echo '<b>'.$artistsmall.'</b>'; ?>

<?php
}
?>
</select>

</br></br>

<b>ARTIST 9</b></br>
<div class="select">
    <select name="top9" required="required">
<?php 
$sq = "SELECT * FROM artist ORDER BY 'name' ASC";
$query = mysql_query($sq);

while($show = mysql_fetch_array($query)){
    $art = $show["name"];
    $artistcap = StrToLower($art);
    $artistsmall = StrToUpper($art);
?>

    <option value=<?php echo '"'.$artistcap.'"'; ?>><?php echo '<b>'.$artistsmall.'</b>'; ?>

<?php
}
?>
</select>

</br></br>

<b>ARTIST 10</b></br>
<div class="select">
    <select name="top10" required="required">
<?php 
$sq = "SELECT * FROM artist ORDER BY 'name' ASC";
$query = mysql_query($sq);

while($show = mysql_fetch_array($query)){
    $art = $show["name"];
    $artistcap = StrToLower($art);
    $artistsmall = StrToUpper($art);
?>
    
    <option value=<?php echo '"'.$artistcap.'"'; ?>><?php echo '<b>'.$artistsmall.'</b>'; ?>

<?php
}
?>
</select>


</br></br>

<input type="submit" name="top" class="button" value="SAVE"/>
</form>

<?php

if(isset($_POST["top"])){
//VARIABLE DECLARATION
    $top1 = $_POST["top1"];
    $top2 = $_POST["top2"];
    $top3 = $_POST["top3"];
    $top4 = $_POST["top4"];
    $top5 = $_POST["top5"];
    $top6 = $_POST["top6"];
    $top7 = $_POST["top7"];
    $top8 = $_POST["top8"];
    $top9 = $_POST["top9"];
    $top10 = $_POST["top10"];


//ENSURE THAT NONE OF THE ARTISTS ARE THE SAME VALUES

//FOR TOP 1
if($top1 != $top2 AND $top1 != $top3 AND $top1 != $top4 AND $top1 != $top5 AND $top1 != $top6 AND $top1 != $top7 AND $top1 != $top8 AND $top1 != $top9 AND $top1 != $top10){
    $read1 = "yes";
        } else { $read1 = "no"; }
    
    //FOR TOP 2
        if($top2 != $top3 AND $top2 != $top4 AND $top2 != $top5 AND $top2 != $top6 AND $top2 != $top7 AND $top2 != $top8 AND $top2 != $top9 AND $top2 != $top10){
    $read2 = "yes";
        } else { $read2 = "no"; }
    
    //FOR TOP 3
    if($top3 != $top4 AND $top3 != $top5 AND $top3 != $top6 AND $top3 != $top7 AND $top3 != $top8 AND $top3 != $top9 AND $top3 != $top10){
        $read3 = "yes";
            } else { $read3 = "no"; }
    
    //FOR TOP 4
    if($top4 != $top5 AND $top4 != $top6 AND $top4 != $top7 AND $top4 != $top8 AND $top4 != $top9 AND $top4 != $top10){
        $read4 = "yes";
            } else { $read4 = "no"; }
    
    //FOR TOP 5
    if($top5 != $top6 AND $top5 != $top7 AND $top5 != $top8 AND $top5 != $top9 AND $top5 != $top10){
        $read5 = "yes";
            } else { $read5 = "no"; }
    
    //FOR TOP 6
    if($top6 != $top7 AND $top6 != $top8 AND $top6 != $top9 AND $top6 != $top10){
        $read6 = "yes";
            } else { $read6 = "no"; }
    
    //FOR TOP 7
    if($top7 != $top8 AND $top7 != $top9 AND $top7 != $top10){
        $read7 = "yes";
            } else { $read7 = "no"; }
        
    //FOR TOP 8
    if($top8 != $top9 AND $top8 != $top10){
        $read8 = "yes";
            } else { $read8 = "no"; }
    
    //FOR TOP 9
    if($top9 != $top10){
        $read9 = "yes";
            }else { $read9 = "no"; }
  
    //CHECK IF THE $READ VALUE IS YES
            
if ($read1 == "yes" AND $read2 == "yes" AND $read3 == "yes"  AND $read4 == "yes" AND $read5 == "yes"  AND $read6 == "yes" AND $read7 == "yes" AND $read8 == "yes" AND $read9 == "yes"){

//RESET ALL "POSITION" VALUES TO "0" BEFORE COMMENCING THE RIGHT ASSIGNMENT
        $general = "UPDATE artist SET position='0'";
        mysql_query($general);

//AFTER RESETTING ALL VALUES, SET THE POSITION FOR ARTIST 1 
        $update1 = "UPDATE artist SET position='1' WHERE name='$top1'";
        mysql_query($update1);

//AFTER RESETTING ALL VALUES, SET THE POSITION FOR ARTIST 2 
        $update2 = "UPDATE artist SET position='2' WHERE name='$top2'";
        mysql_query($update2);

//AFTER RESETTING ALL VALUES, SET THE POSITION FOR ARTIST 3
        $update3 = "UPDATE artist SET position='3' WHERE name='$top3'";
        mysql_query($update3);

//AFTER RESETTING ALL VALUES, SET THE POSITION FOR ARTIST 4 
        $update4 = "UPDATE artist SET position='4' WHERE name='$top4'";
        mysql_query($update4);

//AFTER RESETTING ALL VALUES, SET THE POSITION FOR ARTIST 5 
    $update5 = "UPDATE artist SET position='5' WHERE name='$top5'";
    mysql_query($update5);

//AFTER RESETTING ALL VALUES, SET THE POSITION FOR ARTIST 6 
    $update6 = "UPDATE artist SET position='6' WHERE name='$top6'";
    mysql_query($update6);

//AFTER RESETTING ALL VALUES, SET THE POSITION FOR ARTIST 7 
    $update7 = "UPDATE artist SET position='7' WHERE name='$top7'";
    mysql_query($update7);

//AFTER RESETTING ALL VALUES, SET THE POSITION FOR ARTIST 8 
    $update8 = "UPDATE artist SET position='8' WHERE name='$top8'";
    mysql_query($update8);

//AFTER RESETTING ALL VALUES, SET THE POSITION FOR ARTIST 9 
    $update9 = "UPDATE artist SET position='9' WHERE name='$top9'";
    mysql_query($update9);

//AFTER RESETTING ALL VALUES, SET THE POSITION FOR ARTIST 10 
    $update10 = "UPDATE artist SET position='10' WHERE name='$top10'";
    mysql_query($update10);


        echo '<meta http-equiv="refresh" content="3, url=/admin/artists.php">';
?>
<script>
        alert("Settings Updated!");
</script>

<?php
    }
    else {
        echo '<meta http-equiv="refresh" content="3, url=/admin/artists.php">';
?>
<script>
        alert("You cannot select an artist more than once!!");
</script>
<?php
    }
}
?>