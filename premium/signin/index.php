<?php
session_start();
error_reporting(0);
include("../../connect.php");
include("../header.php");
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://perfectmusic.com.ng/css/premium.css" type="text/css"/>   
<link rel="stylesheet" href="/css/premium.css" type="text/css"/> 
</head>
<title>PM Premium Store - Sign In</title>

<body>
<center>
</br>
<h1>Sign In As A User</h2>

<form action="/premium/signin/" method="POST">
</br></br>

<div class="field">
    <input type="email" name="username" placeholder="eMail Address" required="required"/>
<div class="desc">Your account's email address eg. skrillex19@gmail.com</div>
</div>

<div class="field">
    <input type="password" name="password" placeholder="Your Password" required="required"/>
<div class="desc">Your account's password eg. Iamaboy15#</div>
</div>

</br></br>
<input type="submit" name="signin" class="button-home" value="Sign In"/>
</form>
</br>

<small><font color="#FC3C44"><b>
<?php
echo $_SESSION["msg"];
?>
</b></font></small>
</br></br>

<a href="/premium/signup" class="link">Create a new account</a>

</center>
</br>
</body>
</html>
<?php 
include("../footer.php");
?>


<?php
if(isset($_POST["signin"])){

    $user = $_POST["username"];
    $user = strToLower($user);
    $pass = $_POST["password"];
    $_SESSION["msg"] = "";

    $select = "SELECT * FROM customers WHERE email='$user'";
    $check = mysql_query($select) or die(mysql_error());
    $num = mysql_num_rows($check) or die(mysql_error());
    
    //If user doesn't exist, redirect to login page and echo an error

    if($num == 0){
        $_SESSION["msg"] = "User not found! Check your email address and try again";
        echo '<meta http-equiv="refresh" content="0, url=/premium/signin">';
    }
    else {

        $passcheck = "SELECT * FROM customers WHERE email='$user'";
        $que = mysql_query($passcheck) or die(mysql_error());

        while($data = mysql_fetch_array($que)){

            $password = $data["pass"];
            $pass = md5($pass);
            $name = $data["username"];
            //Check if the password entered matches the one in the database

            if($pass == $password){


                //Session variable declaration
                $_SESSION["msg"] = "";
                $_SESSION["customer"] = $name;
                $_SESSION["email"] = $user;


                   //Take user to creator dashboard
                echo '<meta http-equiv="refresh" content="0, url=/premium/index.php">'; 

                
            } else {

                $_SESSION["msg"] = "Password is incorrect! Try Again";
                echo '<meta http-equiv="refresh" content="0, url=/premium/signin">';

            }
        }
    }
}
?>