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

if(isset($_POST["join"])){
    $name = $_POST["name"];
    $bank = $_POST["bank_name"];
    $acct = $_POST["acct"];
    $whatsapp = $_POST["whatsapp"];

//Check if this person has already entered the giveaway
$chk = "SELECT * FROM giveaway WHERE name='$name' OR acc_no='$acct' OR whatsapp='$whatsapp'";
$sm = mysql_query($chk);
$cnt = mysql_num_rows($sm);

//if the person has not entered
if($cnt < 1){
//Image variable declaration for thumbnail
$dir = "../images/";
$file = $dir.basename($_FILES["thumb"]["name"]);
$uploadfilevalue = 1;
$filetype = pathinfo($file.PATHINFO_EXTENSION);
$lin = "https://godaddypmusic.com/images/".$_FILES["thumb"]["name"];
$image_name = $_FILES["thumb"]["name"];

//Upload file
move_uploaded_file($_FILES["thumb"]["tmp_name"], $file);

$insert = "INSERT INTO giveaway (name, bank, acc_no, photo, whatsapp) 
VALUES('$name', '$bank', '$acct', '$lin', '$whatsapp')";

mysql_query($insert);

?>

<center>
</br></br>
    <font color="orange">
        <img src="../images/tick.png" width="200px" height="200px"/></br></br>
        <b><h4>You have successfully entered the giveaway, keep your fingers crossed!!</h4></b>
</font>
</br>
</br></br>
<a href="https://perfectmusic.com.ng">Go back to <b>Home</b> page</a>
</center>

<?php
}
else {
    echo "<h3>You have already entered for this giveaway!!</h3></br></br>";
}
}
?>

<?php
include("../footer.php");
?>