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
.right {
    text-align : right;
    font-size : 70%;
}
.sect a {
    width : auto;
    height : auto;
    color : orangered;
    text-align : center;
    float : center;
    font-size : 110%;
    text-decoration : none;
    background : white;
    padding : 10px;
    border-radius : 15px;
}
.sect a:hover {
    color : white;
    background : orange;
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
.part {
    border-bottom : 2px solid orange;
    border-top : none;
    border-right : none;
    border-left : none;
    color : white;
    width : auto;
    height : auto;
    padding : 4px;
    margin-bottom : 5px;
}
.email {
    float : center;
    text-align :center;
}
</style>

</head>

<title>Admin Area - Mailing List Management Tool</title>
<body>

<h2>ADMIN TOOLS</h2>
</br>
<?php
echo 'Your current IP address : '.$_SERVER['REMOTE_ADDR'];
?>

</br></br>
<center>

<div class="sect">
<div class="top"><center><h2>Mail Your Subscribers</h2></center></div>
</br>
<div class="type">

<?php
$sqr = "SELECT * FROM email_list";
$result = mysql_query($sqr);
echo '</br><div class="email"><a href="mailto:';
while($show = mysql_fetch_array($result)){
    echo $show["email"].', '; 
}
echo 'admin@godaddypmusic.com"><b>Mail All Subscribers</b></a></div></br>';
?>
</div></div>

<!--Display all email addresses-->

<div class="sect">
<div class="top"><center><h2>View Subscribers</h2></center></div>
</br>
<div class="type">

<?php
$sqr = "SELECT * FROM email_list";
$result = mysql_query($sqr);

while($show = mysql_fetch_array($result)){
echo '<div class="part">';
echo $show["email"];
echo '<div class="right">'.$show["updated"].'</div>';
echo '</div>';
}
?>

</div</div>

