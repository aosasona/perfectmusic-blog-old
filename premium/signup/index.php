<?php
session_start();
error_reporting(0);
include("../../connect.php");
include("../header.php");
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://perfectmusic.com.ng/css/artist.css" type="text/css"/>   
<link rel="stylesheet" href="../../../css/artist.css" type="text/css"/> 
</head>
<title>PM Store - Sign Up</title>

<body>
<center>
</br>
<h1>Sign Up As A User</h2>

<form action="/premium/signup/" method="POST">
</br></br>

<div class="field-short">

    <input type="text" name="first" placeholder="First Name" required="required"/>

    <input type="text" name="last" placeholder="Last Name" required="required"/>

</div>

<div class="field">
    <input type="text" name="email" placeholder="Your eMail Address" required="required"/>
<div class="desc">Enter your email address here eg. johndoe@gmail.com</div>
</div>

<div class="field">
    <input type="text" name="username" placeholder="Choose A Username" required="required"/>
<div class="desc">Enter your desired username here eg. djrado21, tommy15</div>
</div>

<div class="field-short">

    <input type="password" name="pass1" placeholder="Password" required="required" minLength="6"/>

    <input type="password" name="pass2" placeholder="Confirm Password" required="required" minLength="6"/>

</div>

</br></br>
<button type="submit" class="button-home" name="signup">Sign Up</button>
</form>

</br>

<small><font color="#FC3C44"><b>
<?php
echo $_SESSION["msgr"];
?>
</b></font></small>
</br></br>

<a href="/premium/signin" class="link">Sign in as an existing user</a>

</center>
</br>
</body>
</html>
</br>
<?php 
include("../footer.php");
?>

<?php
if(isset($_POST["signup"])){


//SESSION VARIABLE INCLUDED
$first = $_POST["first"];
$last = $_POST["last"];

$email = $_POST["email"];

$username = $_POST["username"];

$pass1 = $_POST["pass1"];
$pass2 = $_POST["pass2"];

date_default_timezone_set("Africa/Lagos");
$date = date('M d, Y');

$check = "SELECT * FROM customers WHERE username='$username' OR email='$email'";
$run_check = mysql_query($check);
$count = mysql_num_rows($run_check);

if($count < 1){

    if($pass1 == $pass2){

$password = md5($pass1);


$add = "INSERT INTO customers(username, pass, stat, email, first_name, last_name, reg_date) VALUES('$username', '$password', 'ACTIVE', '$email', '$first','$last', '$date')";

mysql_query($add) or die(mysql_error()); 

$bal = "INSERT INTO store_balance(username, amount, reg_date) VALUES('$username', '0.00', '$date')";

mysql_query($bal);

$_SESSION["customer"] = $username;
$_SESSION["email"] = $email;


echo '<meta http-equiv="refresh" content="0, url=/premium/signin">';
    }
    else {
        $_SESSION["msgr"] = "Passwords do not match, try again!";
        echo '<meta http-equiv="refresh" content="0, url=/premium/signup">';
    }

} else {
    $_SESSION["msgr"] = "Username or email has been taken!";
    echo '<meta http-equiv="refresh" content="0, url=/premium/signup">';
}

}
?>