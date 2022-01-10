<?php
session_start();
include("../connect.php");
$article_id = $_SESSION["id"];
$section = $_SESSION["section"];
$none1 = $_SESSION["url"];

if(isset($_POST["comment"])){

        $user = $_POST["user"];
        $com = $_POST["text"];
        $com = addslashes($com);
        $com = htmlspecialchars($com);

date_default_timezone_set("Africa/Lagos");
$date = date("d M, Y");

$insert = "INSERT INTO comment(user, comment, article_id, category, updated) VALUES('$user', '$com', '$article_id', '$section', '$date')";
mysql_query($insert) or die(mysql_error());

echo '<meta http-equiv="refresh" content="0, url='.$none1.'">';

    }
?>