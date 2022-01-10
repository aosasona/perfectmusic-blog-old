<?php
error_reporting(-1);

session_start();

include("header.php");

include("../connect.php");

include("validate.php");

date_default_timezone_set("Africa/Lagos");
$date = date('M d, Y');
$day = date('d');

if($day == "21" OR $day == "22" OR $day == "23" OR $day == "24" OR $day == "25"){
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://perfectmusic.com.ng/css/home.css" type="text/css"/>   
<link rel="stylesheet" href="/css/home.css" type="text/css"/> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<title>Withdraw All Funds</title>

<body><center>
    <h1>WITHDRAW ALL FUNDS</h1></br>
    <form action="/artist/withdraw.php" method="post">
    <div class="field">
    <input type="text" name="name" placeholder="Your Bank Account's Name" required="required"/>
<div class="desc">Your bank account's name eg. John Smith Doe</div>
</div></br>

<div class="field">
    <input type="text" name="number" placeholder="Your Bank Account's Number" required="required"/>
<div class="desc">Your bank account's number eg. 11100098653</div>
</div></br>

<div class="field">
    <input type="text" name="bank" placeholder="Your Bank's Name" required="required"/>
<div class="desc">Your bank's name eg. Kuda Microfinance Bank</div>
</div></br>

</br></br>
<input type="submit" name="payout" class="button-home" value="Withdraw"/>
</br></br> <div class="artistname">ENSURE ALL DETAILS ARE CORRECT</div></br>
</form>

</center>
</br>
</body>
</html>
<?php 
include("footer.php");
?>
<?php
}
else {
    echo '<meta http-equiv="refresh" content="0, url=/artist/dashboard.php">';
}
?>

<?php

if(isset($_POST["payout"])){
    $username = $_SESSION["username"];
    $name = $_POST["name"];
    $bank = $_POST["bank"];
    $number = $_POST["number"];

date_default_timezone_set("Africa/Lagos");
$date = date('M d, Y');
$day = date('d');

$sql = "SELECT * FROM balance WHERE username='$username'";
$run = mysql_query($sql);

while($balance = mysql_fetch_array($run)){
    $amount = $balance["amount"];

    $insert = "INSERT INTO withdraw (username, amount, name, bank, account, status, updated) VALUES('$username', '$amount', '$name', '$bank', 
    '$number', 'PENDING', '$date')";
    mysql_query($insert);

    $update = "UPDATE balance SET amount='0.00' WHERE username='$username'";
    mysql_query($update);
}
echo '<meta http-equiv="refresh" content="0, url=/artist/dashboard.php">';
}
?>