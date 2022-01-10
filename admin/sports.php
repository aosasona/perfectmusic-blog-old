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
    width : auto;
    font-size : 110%;
}
</style>

</head>

<title>Admin Area - Sports</title>
<body>

<h2>ADMIN TOOLS</h2>
</br>
<?php
echo 'Your current IP address : '.$_SERVER['REMOTE_ADDR'];
?>

</br></br>

<center>

<!--News deletion section -->
<div class="sect">
<div class="top"><center><h2>Manage Sports</h2></center></div>
</br>
<div class="type">

<?php
$sng = "SELECT * FROM news WHERE article_type='sports' ORDER BY id DESC";
$res = mysql_query($sng);


while($song = mysql_fetch_array($res)){

 echo '<div class="delshow"><b>'.$song["name"].' (Views : <b>'.$song["views"].'</b>)';
 echo "</b>";
 echo '<a href="deletenews.php?id='.$song["id"].'">Delete</a>';
 echo "</div></br>";

}

?>

</div>
</div>
</center>
</html>