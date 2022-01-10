<?php
include("../connect.php");

$id = $_GET["id"];

$sql = "DELETE FROM mix WHERE id='$id'";
mysql_query($sql);

echo '<meta http-equiv="refresh" content="0, url=/admin/index.php">';
?>