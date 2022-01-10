<?php
include("../header.php");
include("../../connect.php");
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://perfectmusic.com.ng/css/artist.css" type="text/css"/>   
<link rel="stylesheet" href="../../../css/artist.css" type="text/css"/> 
</head>
<title>PM Creators - Upload A Profile Picture</title>

<body>
<center>
</br>
<h1>Upload A Profile Picture</h2>
</br></br></br>

<img src="../../images/user.png" class="artist-profile"/></br></br></br></br>

<form action="/artist/signup/plan.php" method = "POST" enctype="multipart/form-data">

<input type="file" name="photo" id="photo" required="required"/></br>

</br></br></br></br>
<button type="submit" class="button-home" name="next">Next</button>
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
    $_SESSION["first"] = $_POST["first"];
    $_SESSION["last"] = $_POST["last"];
    $_SESSION["name"] = $_POST["name"];
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["phone"] = $_POST["phone"];
    $_SESSION["username"] = $_POST["username"];
    $_SESSION["pass1"] = $_POST["pass1"];
    $_SESSION["pass2"] = $_POST["pass2"];
    $_SESSION["about"] = addslashes(htmlspecialchars($_POST["about"]));
}
?>