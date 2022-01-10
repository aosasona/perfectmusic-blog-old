<html>
    <head>
    <link rel="stylesheet" href="/css/footer.css" type="text/css"/>  
    <style>
  img.stuck {
      max-width : 50px;
      position : fixed;
      bottom : 12px;
      right : 12px;
      background : white;
      padding : 6px;
      border-radius : 50%;
  }
</style>
    </head>

<body>



</br>
<center>
<!-- <div class="sectionc">
<div class="toppartc"><b>ADVERTISEMENT</b></div> -->
<?php
//Check the ad status
$sq = "SELECT * FROM ad_status";
$res = mysql_query($sq);
while($dat = mysql_fetch_array($res)) {

    if($dat["switch"] == "on"){

$sql = "SELECT * FROM advert ORDER BY id DESC LIMIT 4 ";
$result = mysql_query($sql);
echo '<div class="slideshow-container">';
while($show = mysql_fetch_array($result)) {

    echo '<div class="mySlides fade"><a href="'.$show["link"].'"><img src="'.$show["photo"].'" class="adimage"/></a></div>';
 
} 
echo '</div>';
echo '<br><div style="text-align:center">  <span class="dot"></span>   <span class="dot"></span>   <span class="dot"></span>
<span class="dot"></span></div>';
    }
    else {
        echo "<small>Ads are currently disabled by the admin</small>";
    }
}
?>
<!-- </div> -->
</center>


</br></br></br>
<div class="footer">
<center>
    <div class="sub">
        <h1>
<b>Join our </b>
<?php
$sql = "SELECT * FROM email_list";
$res = mysql_query($sql);
$count = mysql_num_rows($res);
$cnt = number_format($count);

echo '<font color="red"><big><b>'.$cnt.'</b></big></font> ';
?>
<b>Subscribers</b>
</h1>


    <form method="post" action="https://perfectmusic.com.ng/add_email.php" id="subscribe">
        
<div class="field">
<small>Get latest Music & Entertainment Gist Updates</small></br>
    <input type="email" name="mail" required="required" placeholder="Email Address"/>
    <input type="submit" name="add" class="button" value="Subscribe"/>
    </div>
</form>
</div>

</center>
<center>
    <div>
<div class="navlink">

<div class="left">
<font color="green"><b>Hot Categories</b></font></br></br>
<a href="https://perfectmusic.com.ng/talk-zone/">Talk Zone</a></br></br>
<a href="https://perfectmusic.com.ng/dj-mix/">Mixtapes</a></br></br>
<a href="https://perfectmusic.com.ng/giveaway">PM Giveaway</a></br></br>
<a href="https://perfectmusic.com.ng/btc">Buy/Sell Bitcoin</a></br></br>
</div>


<div class="right">
<font color="green"><b>Information</b></font></br></br>
<a href="https://perfectmusic.com.ng/promote">Advertise on PM</a></br></br>
<a href="https://wa.me/2348139285896?text=Hello%20DJ%20Rado%2C%20I%20would%20like%20to%20upload%20a%20file%20to%20your%20website"> Upload your
 file </a></br></br>
<a href="https://wa.me/2348139285896?text=Copyright%20Issue%20Report">Copyright Issues</a></br></br>
<a href="https://godaddypmusic.com/contact.php">Contact Us</a></br></br>
</div>

</div>
</div>
</center>

</br></br></br></br></br></br></br></br>

<div class="copyright">
<center>
<div class="social">
<a href="https://facebook.com/Perfectmusic9ja"><img src="/images/Facebook.png" class="foot-icon"/></a>
<a href="https://instagram.com/Perfectmusic9ja"><img src="/images/Instagram.png" class="foot-icon"/></a>
<a href="https://twitter.com/IDjrado"><img src="/images/Twitter.png" class="foot-icon"/></a>
<a href="https://wa.me/2348139285896"><img src="/images/Whatsapp.png" class="foot-icon"/></a>
</div>
</center>
<?php
date_default_timezone_set("Africa/Lagos");
$yy = date("Y");

echo "</br></br>";
echo '<center><small><b>Copyright &copy; 2020 - '.$yy.' PerfectMusic.com.ng</b></br>Designed By Aer Info-Tech</small></center>';
?>
</div>
</div>

<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 5000); // Change image every 2 seconds
}
</script>
</body>
</html>