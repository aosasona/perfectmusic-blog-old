<?php
$ip = $_SERVER['REMOTE_ADDR'];

$sep = "SELECT * FROM visit_log WHERE ip='$ip' AND category='$category' AND fileid='$id'";
$re = mysql_query($sep);
$cnt = mysql_num_rows($re);

if($cnt < 1){
$sqe = "INSERT INTO visit_log (ip, category, fileid) VALUES('$ip', '$category', '$id')";
mysql_query($sqe);
}
?>