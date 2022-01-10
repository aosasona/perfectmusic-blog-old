<?php
include("../connect.php");
include("../header.php");
include("cron.php");
error_reporting(-1);

?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" href="../images/favicon.png">

<style>
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
    -webkit-appearance: none;
}
.topm {
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
    text-align : left;
}
.field2 input {
    width : 70%;
    height : auto;
    padding : 8px;
    border : 2px solid orange;
    margin-top : 2px;
    margin-bottom : 5px;
    text-align : left;
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

</style>

</head>

<title>Login To Editor's Account</title>
<body>

</br>
<?php
echo 'Your current IP address : '.$_SERVER['REMOTE_ADDR'];
?>

</br></br>

<center>

<!--Account creation section -->
<div class="sect">
<div class="topm"><center><h2>Login With Editor's Account</h2></center></div>
</br>
<div class="type">

<form action="/editor/index.php" method = "POST">
</br></br>


<div class="field2">
<b>Username</b></br>
    <input type="text" name="username" placeholder="Username" required="required"/>
</div>
</br></br>
<div class="field2">
<b>Password</b></br>
    <input type="password" name="pass" placeholder="Password" required="required"/>
</div>
</br></br>

<input type="submit" name="login" class="button" value="Login"/>

</div>
</div>
</form>

<?php
if(isset($_POST["login"])){
session_start();
    $username = $_POST["username"];
    $password = md5($_POST["pass"]);

    $sql = "SELECT * FROM subadmin WHERE username='$username'";
    $res = mysql_query($sql) or die(mysql_error());
    $count = mysql_num_rows($res) or die(mysql_error());

    if($count > 0){

        while($select =  mysql_fetch_array($res)){
            
            if($password == $select["pass"]){
        
        $_SESSION["editor"] = $username;

        echo '<meta http-equiv="refresh" content="0, url=/editor/main.php">';
            }
        else {
            echo '<meta http-equiv="refresh" content="0, url=/editor/index.php">';
    ?>
    <script>
            alert("Incorrect passowrd!!");
    </script>
    <?php
            }
        }
    }
    else {
        echo '<meta http-equiv="refresh" content="0, url=/editor/index.php">';
    ?>
    <script>
        alert("User not found!!");
    </script>
    <?php
         }
    }
?>

</body>

<?php
include("../footer.php");
?>