<?php

include $_SERVER["DOCUMENT_ROOT"]."/connect.php";

error_reporting(-1);


if(isset($_POST["comment"])){

        $user = $_POST["user"];
        $com = $_POST["text"];
        $com = addslashes($com);
        $com = htmlspecialchars($com);
        $article_id = $_POST["art_id"];
        $none1 = "/article/index.php?id=".$article_id;
        $section = $_POST["cat"];


date_default_timezone_set("Africa/Lagos");
$date = date("d M, Y");

$insert = "INSERT INTO comment(user, comment, article_id, category, updated) VALUES('$user', '$com', '$article_id', '$section', '$date')";
mysql_query($insert) or die(mysql_error());

echo '<meta http-equiv="refresh" content="0, url='.$none1.'">';

    }
?>