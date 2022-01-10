<?php
session_start();
include("../connect.php");
include("validate.php");
$id = $_POST["id"];
$_SESSION["id"] = $id;
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://perfectmusic.com.ng/css/premium.css" type="text/css"/>   
<link rel="stylesheet" href="/css/premium.css" type="text/css"/> 

<style>
    body {
        margin-top : 1%;
    }
</style>

</head>
<title>PM Premium Store</title>

<body>
    <Center></br></br></br></br>
    <h1>How do you want to pay?</h1></br></br></br></br></br>
    <a href="/pay/buy_account.php" class="button-home">With my account balance</a></br></br></br></br></br>
    <a href="https://flutterwave.com/pay/pmpremium" class="button-home">Via flutterwave (ATM card etc)</a></br></br></br>
    </br></br>
</center>
    <?php
$customer = $_SESSION["customer"];
$me = "SELECT * FROM customers WHERE username='$customer'";
$ru = mysql_query($me);

$meb = "SELECT * FROM store_balance WHERE username='$customer'";
$rub = mysql_query($meb);

while($profile = mysql_fetch_array($ru)){
    while($balance = mysql_fetch_array($rub)){
?>
<div class="footer-profile">
Store ID : <?php echo $profile["email"]; ?></br>
N<?php echo number_format($balance["amount"]); ?> Credit</br></br>
<a href="https://wa.me/2348067829109" class="footer-btn">Purchase Code</a> <a href="/premium/redeem.php" class="footer-btn">Redeem Code</a> <a href="/premium/signout" class="footer-btn">Log Out</a>
</div>
<?php
    }
}
?>

</body>
</html>
</br>
<?php 
include("footer.php");
?>