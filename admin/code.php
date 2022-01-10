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
body
*{ 
  padding: 0px;
  font-family : arial;
}
.sect {
    background : #333333;
    color : orange;
    width : 96%;
    height : auto;
    padding-bottom : 10px;
    border : none;
    border-radius : 10px;
    margin-bottom : 4%;
    text-align : left;
}
.button {
    color : white;
    background : orange;
    border : none;
    width : auto;
    height : auto;
    padding : 14px;
    margin-bottom : 10px;
    -webkit-appearance: none;
}
.top {
    background : orange;
    color : black;
    height : auto;
    width : auto;
    padding : 6px;
    border-radius : 10px 10px 0px 0px;
}
.type {
    margin-left : 12px;
    margin-right : 12px;
}
.field input {
    width : 30%;
    height : auto;
    padding : 8px;
    border : 2px solid orange;
    margin-top : 2px;
    margin-bottom : 5px;
}
.field2 input {
    width : 80%;
    height : auto;
    padding : 8px;
    border : 2px solid orange;
    margin-top : 2px;
    margin-bottom : 5px;
}
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

<title>Admin Area - Perfect Music Control Panel</title>
<body>

<h2>ADMIN TOOLS</h2>
</br>
<?php
echo 'Your current IP address : '.$_SERVER['REMOTE_ADDR'];
?>

</br></br>
<center>
<div class="sect">
<div class="top"><center><h2>Add A New eCode</h2></center></div>
</br>
<div class="type">
<form  action="code.php" method="POST">
<div class="field2">
    <input type="text" maxlength="16" name="code" placeholder="XXXXXXXXXXXXXXXX" required="required"/>
</div>
</br>
<div class="field">
<input type="number" name="value" placeholder="VALUE IN NGN" required="required" maxlength="16"/>
</div>
</br>
    <input type = "submit" class="button" name = "submit" value="ADD +"/>

    </form>
    </center>
</div>
</body>
</html>

<?php
error_reporting(0);

if(isset($_POST["submit"])){
$code = $_POST["code"];
$code = StrToUpper($code);
$value =  $_POST["value"];
    //definition of variables
$create = "CREATE TABLE IF NOT EXISTS gift(
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(30) NOT NULL,
    value INT(20) NOT NULL,
    status VARCHAR(20) NOT NULL)";

mysql_query($create);

$select = "SELECT * FROM gift WHERE code = '$code'";
$result = mysql_query($select);
$count = mysql_num_rows($result);
$squ = "INSERT INTO gift(code, value, status) VALUES('$code', '$value', 'ACTIVE')";

if($count != 1) {
    mysql_query($squ) or die(mysql_error());
    echo '<small><center><font color="green">'.'Gift card added successfully!'.'</font></center></small>';
} else {
    echo '<small><center><font color="red">'.'Gift card already exists in the database!'.'</font></center></small>';
}

echo '<meta http-equiv="refresh" content="2, url=/admin/code.php">';
}

?>


</br></br>
<center>
<h1>View Codes</h1></br>
<?php

$sql = "SELECT * FROM gift WHERE status='ACTIVE'  ORDER BY value ASC";
$run = mysql_query($sql);

echo '</br></br><div class="scroll"><table style="width:100%;">';
echo '<tr><th>eCode</th><th>Editable Text</th><th>Value</th><th>Action</th></tr>';
        
        while($sub = mysql_fetch_array($run)){

        echo '<tr><td class="title" ><b>'.$sub["code"].'</b></td>';
        echo '<td><input type="text" name="code" id="code" value="'.$sub["code"].'"/></td>';
        echo '<td><b>N'.number_format($sub["value"]).'</b></td>';
        echo '<td><button onClick="copyfunc()" class="btn">Copy</button></td></tr>';

        }
        echo "</table></div>";
?>
</center>

<script>
    function copyfunc() {
        var copyText = document.getElementById("code");

        copyText.select();
        copyText.setSelectionRange(0, 99999);

        document.execCommand("copy");

        alert("eCode has been copied to clipboard");

    }
</script>