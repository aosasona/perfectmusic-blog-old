<?php
include("../connect.php");

$id = $_GET["id"];

$sql = "DELETE FROM news WHERE id='$id'";
mysql_query($sql);

echo '<meta http-equiv="refresh" content="0, url=/admin/admin.php">';
?>