<?php
include("connect.php");
include("header.php");
?>

<title>PerfectMusic - Subscription</title>

<body>

<?php
if(isset($_POST["add"])){

//Variable declaration
$mail = $_POST["mail"];
date_default_timezone_set("Africa/Lagos");
$date = date('M d, Y');

//Check if user is already subscribed
    $sql = "SELECT * FROM email_list WHERE email = '$mail'";
    $res = mysql_query($sql);
    $count = mysql_num_rows($res);

//If user is not subscribed already, add to email list
if($count < 1) {
    $insert = "INSERT INTO email_list(email, updated) VALUES('$mail', '$date')";
    mysql_query($insert) or die(mysql_error());
    echo '<meta http-equiv="refresh" content="0, url=index.php">';
?>
<script>
    window.alert("You have been added to the mailing list, thank you for subscribing... It's entirely FREE!!");
</script>
<?php
}
else {
    echo '<meta http-equiv="refresh" content="0, url=index.php">';
?>
<script>
    window.alert("You are already on our subscribers' list... Thank you.");
</script>
<?php
}
}
?>