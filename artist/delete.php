<?php
error_reporting(-1);
include("header.php");
include("../connect.php");
session_start();

$_SESSION["id"] = $_GET["id"];
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://perfectmusic.com.ng/css/home.css" type="text/css"/>   
<link rel="stylesheet" href="../css/home.css" type="text/css"/> 
</head>
<title>Are You Sure ?</title>

<body>
<center>
<form action="/artist/delete_file.php" method="POST">
</br></br></br></br>

<b>Are you sure you want to delete this file ?</b> </br></br></br></br>

<input type="submit" name="yes" class="button-home" value="Yes"/></br></br>
<input type="submit" name="no" class="button-home-no" value="No"/></br>
</form>
</center>
</br></br></br></br>
</body>
</html>
<?php 
include("footer.php");
?>