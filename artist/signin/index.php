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
<title>PM Creators - Sign In</title>

<body>
<center>
</br>
<h1>Sign In As A Creator</h2>

<form action="/artist/signin/" method="POST">
</br></br>

<div class="field">
    <input type="text" name="username" placeholder="Username" required="required"/>
<div class="desc">Your account's username eg. djrado21</div>
</div>

<div class="field">
    <input type="password" name="password" placeholder="Your Password" required="required"/>
<div class="desc">Your account's password</div>
</div>

</br></br>
<input type="submit" name="signin" class="button-home" value="Sign In"/>
</form>
</br></br>

<small><font color="#FC3C44"><b>
<?php
echo $_SESSION["msg"];
?>
</b></font></small>

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

    $select = "SELECT * FROM artist_profile WHERE username='$user'";
    $check = mysql_query($select);
    $num = mysql_num_rows($check);
    
    //If user doesn't exist, redirect to login page and echo an error

    if($num == 0){
        $_SESSION["msg"] = "User not found! Check your username and try again";
        echo '<meta http-equiv="refresh" content="0, url=/artist/signin">';
    }
    else {

        $passcheck = "SELECT * FROM artist_profile WHERE username='$user'";
        $que = mysql_query($passcheck);

        while($data = mysql_fetch_array($que)){

            $password = $data["password"];
            $pass = md5($pass);
            $stat = $data["sub_status"];

            //Check if the password entered matches the one in the database

            if($pass == $password){

                $name = $data["name"];

                //Session variable declaration
                $_SESSION["msg"] = "";
                $_SESSION["username"] = $user;
                $_SESSION["name"] = $name;

                if($stat != "ACTIVE"){

                //Take user to subscription page
                echo '<meta http-equiv="refresh" content="0, url=/artist/signup/plan.php">';

                } else {

                   //Take user to creator dashboard
                echo '<meta http-equiv="refresh" content="0, url=/artist/dashboard.php">'; 

                }
            } else {

                $_SESSION["msg"] = "Password is incorrect! Try Again";
                echo '<meta http-equiv="refresh" content="0, url=/artist/signin">';

            }
        }
    }
}
?>