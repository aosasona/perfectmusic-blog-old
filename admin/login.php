<?php
include("../connect.php");
include("../header.php");
?>

<html>
<head>
<style>
    a{
        text-decoration : none;
        color : orange;
    }
    .data{
        background : #111111;
        color : orange;
        width : auto;
        height : auto;
        padding : 20px;
        padding-top : 60px;
        padding-bottom : 60px;
    }
    .pass input{
        background : #222222;
        color: orange;
        width : auto;
        height : auto;
        padding : 15px;
        border-radius : 8px;
        border : none;
        text-align : center;
        font-size : 120%;
    }
    .bt{
        color : white;
        background : orange;
        border : none;
        width : auto;
        height : auto;
        border-radius : 5px;
        font-size : 110%;
        padding : 3%;
    }
    .bt:hover {
        color : orange;
        background : white;
    }
</style>
</head>

<title>Login To Access Admin Area</title>
<body>
</br></br></br>
<form method="POST" action="/admin/login.php">
<center>
<div class="data">

<B><SMALL>ENTER PASSWORD TO CONTINUE</SMALL></B>
</br></br>

<div class="pass">
<input type="password" id="pass" name="password" placeholder="Enter Password Here..." required="required"/></br>
</div>
</br>

<input type="checkbox" onclick="myFunction()">Show Password </br></br></br>
<input type = "submit" name="login" class="bt" value="Sign In"/></br>

</br></br>

<a href="/admin/reset.php">Clear last login (if you keep getting redirected to the homepage)</a>
<script>
//Show/Hide Password
function myFunction() {
  var x = document.getElementById("pass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

</div>
</center>
</form>

</br></br></br>
<?php
include("../footer.php");
?>
</html>


<?php
session_start();
if(isset($_POST["login"])){
    $pass = $_POST["password"];
    $orig = "Ayomide2020";

    if($pass === $orig){
        $_SESSION["log"] = "yes";
        echo '<meta http-equiv="refresh" content="0, url=/admin/index.php">';
    }
    else{
?>

<meta http-equiv="refresh" content="0, url=/admin/login.php">

<script>
    window.alert("Password is incorrect! Try Again");
</script>
<?php
    }
}
?>