<?php
include("../connect.php");
include("../header.php");
?>
<head>
    <style>
h3 {
    font-size : 250%;
    color : black;
    font-family : Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
}
    </style>
</head>
<title>PerfectMusic Giveaway</title>

<body>
<center>
</br></br>
<?php

$squ = "SELECT * FROM giveaway_status";
$req = mysql_query($squ);

while($data = mysql_fetch_array($req)){
    if($data["switch"] =="on"){
?>
<h3>Yohoo!! You're in luck.</h3>
<h5><b>Fill the form below to enter the giveaway</b></h5>

<form action="/giveaway/enter.php" method = "POST" enctype="multipart/form-data">
</br></br>
<div class="field1">
    <input type="text" name="name" placeholder="Enter Your Name Here..." required="required"/>
</div>

<div class="select">
    <b>SELECT BANK</b></br>
    <select name="bank_name">
        <option value="Access Bank PLC">Access Bank PLC</option>
        <option value="Access-Diamond Bank">Access (Diamond) Bank PLC</option>
        <option value="Citibank Nigeria Ltd">Citibank Nigeria Ltd</option>
        <option value="EcoBank">EcoBank Nigeria PLC</option>
        <option value="Fidelity Bank">Fidelity Bank</option>
        <option value="First Bank">First Bank PLC</option>
        <option value="FCMB">First City Monument Bank (FCMB)</option>
        <option value="GT Bank">Guaranty Trust Bank PLC</option>
        <option value="GoMoney">GoMoney</option>
        <option value="Heritage Bank">Heritage Bank</option>
        <option value="Jaiz Bank">Jaiz Bank</option>
        <option value="Keystone Bank">Keystone Bank</option>
        <option value="Kuda Bank">Kuda Bank</option>
        <option value="PalmPay">Palmpay</option>
        <option value="Polaris Bank">Polaris Bank</option>
        <option value="Providus Bank">Providus Bank</option>
        <option value="Rubies Bank">Rubies (Highstreet) Bank</option>
        <option value="Stanbic IBTC">Stanbic IBTC Nigeria</option>
        <option value="Standard Chartered Bank">Standard Chartered Bank</option>
        <option value="Sterling Bank">Sterling Bank</option>
        <option value="Union Bank">Union Bank</option>
        <option value="UBA">United Bank for Africa PLC</option>
        <option value="Unity Bank">Unity Bank</option>
        <option value="VFD (V) Bank">VFD (V by VFD) Bank</option>
        <option value="Wema Bank">Wema Bank</option>
        <option value="Zenith Bank">Zenith Bank</option>
</select>
</div>
<div class="field2">
    <input type="text" name="acct" placeholder="Enter Your Account Number Here..." required="required"/>
</div>

<div class="field2">
    <input type="text" name="whatsapp" placeholder="Enter Your WhatsApp Number Here..." required="required"/>
</div>

<b>Select related/required image eg. proof of an action (if none, select a picture of yourself)</b> : 
<input type="file" name="thumb" id="thumb"/></br>
</br>

<input type="submit" name="join" class="buttn" value="Enter Giveaway"/>

</div>
    </form>

<?php
    }
    else {
?>
<h3>Oops!! No active giveaway, check again later.</h3></br>
<h4><b>Last Giveaway : <?php echo $data["updated"]; ?></b>
    </br></br>
<?php
    }
}
?>
</center>

<?php
include("../footer.php");
?>