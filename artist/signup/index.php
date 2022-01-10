<?php
include("../header.php");
include("../../connect.php");
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://perfectmusic.com.ng/css/artist.css" type="text/css"/>   
<link rel="stylesheet" href="../../../css/artist.css" type="text/css"/> 
</head>
<title>PM Creators - Sign Up</title>

<body>
<center>
</br>
<h1>Become A Creator</h2>

<form action="/artist/signup/photo.php" method="POST">
</br></br>

<div class="field-short">

    <input type="text" name="first" placeholder="First Name" required="required"/>

    <input type="text" name="last" placeholder="Last Name" required="required"/>

</div>


<div class="field">
    <input type="text" name="name" placeholder="Stage Name" required="required"/>
<div class="desc">Your stage name ONLY eg. Chizzy, DJ Rado etc</div>
</div>

<div class="field">
    <input type="text" name="email" placeholder="Your Active eMail Address" required="required"/>
<div class="desc">Your email address eg. Johndoe@gmail.com</div>
</div>

<div class="field">
    <input type="text" name="phone" placeholder="Your Phone Number" value="+234" required="required"/>
<div class="desc">Your Phone Number eg. +2347030006000</div>
</div>

<div class="field">
    <input type="text" name="username" placeholder="Choose A Username" required="required"/>
<div class="desc">Enter your desired username here eg. djrado21, tommy15</div>
</div>

<div class="field-short">

    <input type="password" name="pass1" placeholder="Password" required="required" minLength="6"/>

    <input type="password" name="pass2" placeholder="Confirm Password" required="required" minLength="6"/>

</div>

<div class="field">
<textarea name="about" placeholder="Tell Us About Yourself eg. HotSkull, born January 1, 2001, raised in Michigan..." required="required"></textarea>
<div class="desc">Type in a PROFESSIONAL description of yourself here</div>
</div>

</br></br>
<button type="submit" class="button-home" name="next">Next</button>
</form>
</center>
</br>
</body>
</html>
</br>
<?php 
include("../footer.php");
?>