<?php
session_start();
include("../connect.php");
include("validate.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://perfectmusic.com.ng/css/premium.css" type="text/css"/>   
<link rel="stylesheet" href="/css/premium.css" type="text/css"/> 

<style>
    body {
        margin-top : 5%;
    }
</style>

</head>
<title>PM Store - Redeem Code</title>

<body>
    <center>
<form action="/premium/redeem.php" method="POST">
<div class="field">
    <input type="text" name="code" placeholder="16-Digit eCode"/>
    <div class="desc">Enter the 16-Digit eCode you purchased eg. XNV67ZS2PLSEQUDG</div>
</div>
</br></br>
<input type="submit" class="button-home" name="redeem" value="Redeem Code"/>
</form>
</br></br>
<font color="#FC3C44"><small>
<?php
echo $_SESSION["ca"];
?>
</small></font>
</br></br>
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

<?php
if(isset($_POST["redeem"])){
    $code = $_POST["code"];
    $code = strToUpper($code);
    
//check for validity of code
    $valid ="SELECT * FROM gift where code='$code'";
    $result = mysql_query($valid);
    $count = mysql_num_rows($result);
if($count == 0) {
    $_SESSION["ca"] = "Gift card e-code is invalid!";
            echo '<meta http-equiv="refresh" content="0, url=/premium/redeem.php">';
    } 

//if code is valid, check if it's active
    $used = "SELECT * FROM gift where code='$code' AND status='USED'";
    $expired = mysql_query($used);
    $num = mysql_num_rows($expired);
    if($num == 1) {
        $_SESSION["ca"] = "This gift card/eCode has been used!";
        echo '<meta http-equiv="refresh" content="0, url=/premium/redeem.php">'; 
    }

//if code is valid and active
    if ($count != 0 AND $num != 1) {

    while($data = mysql_fetch_array($result)){
        $value = $data["value"];
        $user = $_SESSION["customer"];

        $sender = "SELECT * FROM store_balance WHERE username='$user'";
        $res_sender = mysql_query($sender) or die(mysql_error());

        while($send = mysql_fetch_array($res_sender)){
            $samount = $send["amount"];
            
            $total = $samount + $value;

            $ups = "UPDATE store_balance SET amount='$total' WHERE username='$user'";
            mysql_query($ups);
    }
    $sql = "UPDATE gift SET status='USED' WHERE code='$code'";
    mysql_query($sql);
    $_SESSION["ca"] = "Card has been redeemed successfully and ".$value."NGN has been added to your account";
}
    echo '<meta http-equiv="refresh" content="0, url=/premium/redeem.php">';
}
}