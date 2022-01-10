<?php
session_start();
include("../connect.php");
include("../header.php");

error_reporting(-1);

function logged() {
    if(isset($_SESSION["log"])){
        return true;
    }else{
        return false;
    }
}
if(!logged()){
  echo '<meta http-equiv="refresh" content="0, url=/admin/login.php">';
}

$id= $_GET["id"];

$SQL = "UPDATE withdraw SET status='PAID' WHERE id='$id'";
mysql_query($SQL);


echo '<meta http-equiv="refresh" content="0, url=/admin/withdraw.php">';

?>