<?php
include("../header.php");
include("../../connect.php");
session_start();
error_reporting(-1);
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://perfectmusic.com.ng/css/artist.css" type="text/css"/>   
<link rel="stylesheet" href="../../../css/artist.css" type="text/css"/> 
</head>
<title>PM Creators - Select A Subscription Plan</title>

<body>
<center>
</br>
<h1>Subscription Plan</h2>
</br></br>
<font color="#FC3C44"><b><small>Select a plan to activate your account, your songs will remain hidden until you activate your account.</b></font>
</br></br>

<form action="https://flutterwave.com/pay/pmwnp" method="POST">

<button type="submit" class="button-buy">
<h2>Weekly Subscription (Without Promotion)</h2>
<h3>N5,000/week</h3>
</button>

</form>


<form action="https://flutterwave.com/pay/pmwp" method="POST">
    <button type="submit" class="button-buy">
<h2>Weekly Subscription (With Promotion)</h2>
<h3>N10,000/week</h3>
</button>
</form>



<form action="https://flutterwave.com/pay/pmmnp" method="POST">
    <button type="submit" class="button-buy">
<h2>Monthly Subscription (Without Promotion)</h2>

<h3>N10,000/month (+1 day free)</h3>
</button>
</form>


<form action="https://flutterwave.com/pay/pmmp" method="POST">
    <button type="submit" class="button-buy">
<h2>Monthly Subscription (With Promotion)</h2>

<h3>N15,000/month (+1 day free)</h3>
</button>
</form>

</center>
</br>
</body>
</html>
</br>
<?php 
include("../footer.php");
?>

<?php
if(isset($_POST["next"])){
//SESSION VARIABLE INCLUDED
$first = $_SESSION["first"];
$last = $_SESSION["last"];
$name = strToLower($_SESSION["name"]);
$email = $_SESSION["email"];
$phone = $_SESSION["phone"];
$username = $_SESSION["username"];
$pass1 = $_SESSION["pass1"];
$pass2 = $_SESSION["pass2"];
$about = $_SESSION["about"];
date_default_timezone_set("Africa/Lagos");
$date = date('M d, Y');

$check = "SELECT * FROM artist WHERE name='$name' AND username='$username'";
$run_check = mysql_query($check);
$count = mysql_num_rows($run_check);

if($count < 1){

    if($pass1 == $pass2){

$password = md5($pass1);

//Image variable declaration for file upload
$dir = "../../upload/";
$file = $dir.basename($_FILES["photo"]["name"]);
$uploadfilevalue = 1;
$filetype = pathinfo($file.PATHINFO_EXTENSION);
$link = "https://perfectmusic.com.ng/upload/".$_FILES["photo"]["name"];
$image_name = $_FILES["photo"]["name"];

//Upload file
move_uploaded_file($_FILES["photo"]["tmp_name"], $file);

$check_artist = "SELECT * FROM artist WHERE name='$name' AND username='$username'";
$run_artist = mysql_query($check_artist);
$count_artist = mysql_num_rows($run_artist);

//CHECK IF THERE IS ALREADY AN ARTIST'S PROFILE
if($count_artist < 1){

$insert = "INSERT INTO artist(name, photo, position, updated, verify) VALUES('$name', '$link', '0', '$date', 'YES')";

mysql_query($insert)  or die(mysql_error());

}

$add = "INSERT INTO artist_profile(name, username, first, last, email, phone, password, about, sub_status) VALUES('$name', '$username', '$first',
'$last', '$email', '$phone', '$password', '$about', 'INACTIVE')";

mysql_query($add) or die(mysql_error()); 

$bal = "INSERT INTO balance(username, amount, reg_date) VALUES('$username', '0.00', '$date')";
mysql_query($bal);

    }

} else {
    echo '<meta http-equiv="refresh" content="0, url=https://perfectmusic.com.ng/artist/signup">';
}

}
?>