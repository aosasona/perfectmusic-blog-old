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
        margin-top : 1%;
    }
</style>

</head>
<title>PM Premium Store</title>

<body>
    <center>
<form action="/premium/search.php" method="GET">

<div class="search">
    <input type="text" name="query" placeholder="Search..." required="required"/>
    <button type="submit" name="search" class="searchbtn">Search</button>
</div>
</form>
</center>
<?php
//VARIABLE DECLARATION
$id = $_GET["id"];
$_SESSION["item_id"] = $id;
$item_id = $_SESSION["item_id"];
$username = $_SESSION["customer"];

//FETCH SONG'S DATA
$sql = "SELECT * FROM music_upload WHERE id='$id' AND visible='ON' AND premium='YES'";
$query =  mysql_query($sql);

while($data = mysql_fetch_array($query)){
?>

<div class="top">
    <img src=<?php echo '"'.$data["thumb"].'"'; ?> class="thumbnail"/>

    <div class="info">
        
    <h1><?php echo ucfirst($data["name"]); ?></h1>
    <div class="mainartist"><?php echo ucfirst($data["main"]); ?></div> 
    

<?php
//CHECK IF USER HAS ALREADY PURCHASED THE SONG
$chk = "SELECT * FROM purchase_history WHERE username='$username' AND item_id='$item_id'";
$run = mysql_query($chk);

if(mysql_num_rows($run) < 1){
?>
<div class="price">N400</div>
<form action="/premium/method.php" method="POST">
    <input type="hidden" name="id" value=<?php echo '"'.$item_id.'"'; ?> />
    <button type="submit" class="button">Purchase Song</button>
</form>
<?php
}else {
?>
<div class="price">Already purchased</div>
<form action=<?php echo '"'.$data["link"].'"'; ?> method="POST">
    <button type="submit" class="button">Download Song</button>
</form>
<?php
}
?>
</div>
</div>

<div class="about">
<?php echo nl2br(ucfirst($data["about"])); ?>
</div>
<div class="more">
    Featuring : <?php echo ucfirst($data["feature"]); ?></br>
    Uploaded On : <?php echo $data["updated"]; ?>
</div>
<?php
}
?>

<center>
<div class="category">Random Picks</div>
<?php

$sql = "SELECT * FROM music_upload WHERE visible='ON' AND premium='YES' ORDER BY rand() LIMIT 10";
$result = mysql_query($sql);

$count = mysql_num_rows($result);
if($count == 0) {

    echo "<b>No Premium Songs Yet.</b>";

}
else{
while($show = mysql_fetch_array($result)) {
    $title = $show["name"];
    $id = $show["id"];
    include("../url.php");
    if(strlen($show["name"]) > 40){
        $name = substr($show["name"], 0, 38).'...';
    }
    else {
        $name = $show["name"];
    }
    echo '<img src="'.$show["thumb"].'" class="tabcontentimg"/><div class="display-music">';
    echo '<b><a href="/premium/display.php?article='.$title.$id.'&id='.$show["id"].'" class="title">'.$name.'</a></b></div>';

}
}

?>
</center>
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