<?php
include("connect.php");
include("header.php");
?>

<title>PerfectMusic - Entertainment for All!!</title>

<body>
</br></br>
<center>
    <h1><big>B</big>UY & <big>S</big>ELL <big>B</big>ITCOIN</h1>
</br></br>
<form action="coins-trans.php" method="POST">

<div class="select">
    <select name="type">
<option value="buy"><b>Buy BTC</b></option>
<option value="sell"><b>Sell BTC</b></option>
    </select>
</div>

<div class="fid">
<input type="text" name="amount"/></br>
</div>
<input type="submit" name="trans" value="Send" class="buttn"/>

</form>
</center>

</br>

<?php
include("footer.php");
?>