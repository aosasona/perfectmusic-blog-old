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

?>

<html>
<head>
<link rel="stylesheet" href="../stylesheet.css" type="text/css"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="../images/favicon.png">

<style>
.scroll {
    overflow-x : auto;
}
table {
    width : 100%;
    border : none;
    border-collapse : collapse;
    overflow-x : auto;
    table-layout : auto;
    color : orangered;
}
th {
    padding : 4px;
    background : #EEE;
    text-align : center;
    color : orangered;
}
td {
    padding : 5px;
    text-align : center;
    background : rgba(247, 247, 247, 0.801);
    color : orangered;
}
td.title {
    text-align : left;
    color : black;
}
a.action {
    color : #091D38;
    padding : 2px;
    border-radius : 10px;
    font-size : 75%;
    font-weight : 750;
    font-family : Calibri, sans-serif;
    margin-left : 4px;
}
</style>
</head>

<title>View Withdrawals</title>
<body>

</br></br>

<?php

$sql = "SELECT * FROM withdraw WHERE status='PENDING' ORDER BY id DESC";
$run = mysql_query($sql);

echo '</br></br><div class="scroll"><table style="width:100%;">';
echo '<tr><th>Username</th><th>Name</th><th>Bank Name</th><th>Account Number</th><th>Date</th><th>Action</th></tr>';
        
        while($sub = mysql_fetch_array($run)){

        echo '<tr><td class="title">'.$sub["username"].'</td>';
        echo '<td>'.$sub["name"].'</td>';
        echo '<td>'.$sub["bank"].'</td>';
        echo '<td>'.$sub["account"].'</td>';
        echo '<td>'.$sub["updated"].'</td>';
        echo '<td> <a href="paid.php?id='.$sub["id"].'" class="action">Mark As Paid</a></td></tr>';

        }
        echo "</table></div>";
?>