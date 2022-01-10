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
.field2 input {
    width : 70%;
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
    width : 90%;
    font-size : 100%;
    padding : 10px;
    float : center;
}

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: green;
}

input:focus + .slider {
  box-shadow: 0 0 1px green;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
.show {
    padding : 15px;
}
img.pic {
    max-width : 300px;
}
</style>

</head>

<title>Admin Area - Giveaway Management Tool</title>
<body>

<h2>ADMIN TOOLS</h2>
</br>
<?php
echo 'Your current IP address : '.$_SERVER['REMOTE_ADDR'];
?>

</br></br>
<center>
<div class="sect">
<div class="top"><center><h2>Giveaway Activation Switch</h2></center></div>
</br>
<div class="type">

<form action="/admin/giveaway.php" method="POST">
</br>
<label class="switch">
  <input type="checkbox" name="status" value="on">
  <span class="slider round"></span>
</label>
</br></br></br>
<input type="submit" name="switch" value="SAVE SETTINGS" class="button"/>
</br>
</br>

<small><b>EVERY DETAIL WILL BE DELETED EVERYTIME YOU TURN ON THE SWITCH TO ACTIVATE A GIVEAWAY</b></small>
</form>

<?php
if(isset($_POST["switch"])){
    $checkbox = $_POST["status"];
    date_default_timezone_set("Africa/Lagos");
    $date = date('M d, Y');

    if(isset($checkbox)){
        $sql = "UPDATE giveaway_status SET switch = 'on', updated='$date'";

        $reset = "TRUNCATE giveaway";
        mysql_query($reset);
    } else {
        $sql = "UPDATE giveaway_status SET switch = 'off', updated='$date'";
    }
    mysql_query($sql);

    echo '<meta http-equiv="refresh" content="0, url=/admin/giveaway.php">';
}
?>

</div></div>

</br></br>
<center>
<div class="sect">
<div class="top"><center><h2>Random Winner Picker</h2></center></div>
</br>
<?php

$take = "SELECT * FROM giveaway ORDER BY RAND() LIMIT 5";
$query = mysql_query($take);

while($win = mysql_fetch_array($query)){
echo '<div class="show">';
echo '<b>NAME : <font color="white">'.$win["name"].'</font></br></br>';
echo '<b>BANK NAME : <font color="white">'.$win["bank"].'</font></br></br>';
echo '<b>BANK ACCOUNT NUMBER (NUBAN) : <font color="white">'.$win["acc_no"].'</font></br></br>';
echo '<b>WHATSAPP NUMBER : <font color="white">'.$win["whatsapp"].'</font></br></br><center>';
echo '<img src="'.$win["photo"].'" class="pic"/></center></br>';
echo '</div></br>';
}
?>
</center>