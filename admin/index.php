<?php
session_start();
include("../connect.php");
include("../header.php");
include("cron.php");
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
a{
        text-decoration : none;
}

.accordion {
  background-color: #111111;
  color: orange;
  cursor: pointer;
  padding: 18px;
  width: 90%;
  text-align: left;
  border: none;
  outline: none;
  transition: 0.3s;
  margin-top : 30px;
}

.active, .accordion:hover {
  background-color: white;
}

.panel {
  padding: 0 18px;
  background-color: #222222;
  width : 85%;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
}
.accordion:after {
  content: '\02795'; /* Unicode character for "plus" sign (+) */
  font-size: 13px;
  background : white;
  color: orange;
  float: right;
  margin-left: 5px;
}

.active:after {
  content: "\2796"; /* Unicode character for "minus" sign (-) */
}
.textc input {
    border-bottom : 2px solid white;
    width : 60%;
    border-left : none;
    border-right : none;
    border-top : none;
    padding : 2%;
    color : white;
    background-color : transparent;
    text-align : center;
    font-style : Arial;
    margin-bottom : 5%;
}
.textc input:hover {
    border-bottom : 2px solid orange;
    background-color : white;
    color : black;
}
.del {
  text-align : left;
  margin-bottom : 18px;
  background : #222222;
  padding : 10px;
}
.del a{
  color : red;
}
.del a:hover {
  color : white;
}
.btn2{
  color : white;
  background : orange;
  width : auto;
  height : auto;
  padding : 8px;
  border : none;
}
.btn2:hover {
  color : orange;
  background : white;
}
a{
  color : orange;
}
</style>

</head>

<title>Admin Area</title>
<body>

<h2>ADMIN TOOLS</h2>
</br>
<?php
echo 'Your current IP address : '.$_SERVER['REMOTE_ADDR'];
?>

</br></br>
<a href="/admin/admin.php"><b>Switch To PerfectMusic CPanel</b></a>
</br>
</br>

<!-- Website stats -->
<center>
<button class="accordion">Website Stats</button>
<div class="panel">
  <p>
<?php
$vis = "SELECT * FROM visit";
$visit = mysql_query($vis);

while($visitor = mysql_fetch_array($visit)){
  echo "Total number of site visits : ".$visitor["counting"];
  echo "</br></br>Last visit : ".$visitor["dd"].' '.$visitor["mm"].', '.$visitor["yyyy"];
}
?>

  </p>
</div>

<button class="accordion">View Messages</button>
<div class="panel">
  <p>
<?php
$con = "SELECT * FROM contact ORDER BY id DESC";
$resu = mysql_query($con);
echo "<ul>";
while($contact = mysql_fetch_array($resu)){
  echo '<div class="del">';
  echo '<li>';
  echo "<small><i>".$contact["updated"]."</i></small></br>";
  echo '<h3>'.$contact["person"].'(<a href="mailto:'.$contact["email"].'">Reply via e-mail</a>)</h3>';
  echo "</br><b>Phone Number :</b> ".$contact["phone"];
  echo "</br>";
  echo "</br> <b>Message : </B>".$contact["info"];
  echo '</li>';
  echo "</div>";
}
echo "</ul>";
?>

  </p>
</div>

<!-- Add a new highlight -->

<button class="accordion">Add a new highlight</button>
<div class="panel">
  <p>

<form action="/admin/index.php" method = "POST" enctype="multipart/form-data">
<div class="textc">
<input type="text" name="title" placeholder="Highlight's title" required="required"/>
</div>

</br></br>
<b>Select an highlight (image) to upload</b> : 
<input type="file" name="photo" id="photo"/></br>
<font color="orange"><small>Image size must be smaller than 1MB</small></font>
</br></br>

<input type="submit" class="btn2" name="high" value="Upload"/>
</form>

<?php
if(isset($_POST["high"])){

//Variable declaration
  $title = $_POST["title"];
  $title = addslashes($title);
  date_default_timezone_set("Africa/Lagos");
  $date = date('M d, Y');

//Image variable declaration
  $dir = "../images/";
  $file = $dir.basename($_FILES["photo"]["name"]);
  $uploadfilevalue = 1;
  $filetype = pathinfo($file.PATHINFO_EXTENSION);
  $link = "/images/".$_FILES["photo"]["name"];
  $image_name = $_FILES["photo"]["name"];

//Upload file
  move_uploaded_file($_FILES["photo"]["tmp_name"], $file);


  $insert = "INSERT INTO highlights (txt, img, updated) 
  VALUES('$title', '$link', '$date')";

  mysql_query($insert);
  echo '<meta http-equiv="refresh" content="0, url=/admin/index.php">';
?>
<script>
    window.alert("Highlight added successfully");
</script>
<?php
}  
?>

  </p>
</div>


<!-- Upload a new song -->

<button class="accordion">Upload a new song</button>
<div class="panel">
  <p>

<form action="/admin/index.php" method = "POST" enctype="multipart/form-data">
<div class="textc">
<input type="text" name="title" placeholder="Song's title" required="required"/>
</div>

<div class="textc">
<input type="text" name="link" placeholder="Song's Audiomack Link" required="required"/>
</div>

<textarea cols="40" rows="6" name="about" required="required" Placeholder="Description"></textarea>
</br></br>

<b>Select image to upload</b> : 
<input type="file" name="photo" id="photo"/></br>
<font color="orange"><small>Image size must be smaller than 1MB</small></font>
</br></br>

<div class="textc">
<input type="text" name="feature" placeholder="Featuring..."/>
</div>

<input type="submit" class="btn2" name="song" value="Upload"/>
</form>

<?php
if(isset($_POST["song"])){

//Variable declaration
  $title = $_POST["title"];
  $title = addslashes($title);
  $lin = $_POST["link"];
  $about = $_POST["about"];
  $about = addslashes($about);
  $feature = $_POST["feature"];
  $feature = addslashes($feature);
  date_default_timezone_set("Africa/Lagos");
  $date = date('M d, Y');

//Image variable declaration
  $dir = "../images/";
  $file = $dir.basename($_FILES["photo"]["name"]);
  $uploadfilevalue = 1;
  $filetype = pathinfo($file.PATHINFO_EXTENSION);
  $link = "/images/".$_FILES["photo"]["name"];
  $image_name = $_FILES["photo"]["name"];

//Upload file
  move_uploaded_file($_FILES["photo"]["tmp_name"], $file);


  $insert = "INSERT INTO song (title, link, about, thumb, feature, updated) 
  VALUES('$title', '$lin', '$about', '$link', '$feature', '$date')";

  mysql_query($insert);
  echo '<meta http-equiv="refresh" content="0, url=/admin/index.php">';
?>
<script>
    window.alert("Song uploaded successfully");
</script>
<?php
}  
?>

  </p>
</div>


<!-- Upload a new mixtape -->

<button class="accordion">Upload a new mixtape</button>
<div class="panel">
  <p>

<form action="/admin/index.php" method = "POST" enctype="multipart/form-data">
<div class="textc">
<input type="text" name="title" placeholder="Mixtape's title" required="required"/>
</div>

<div class="textc">
<input type="text" name="link" placeholder="Mixtape's Audiomack Link" required="required"/>
</div>

<textarea cols="40" rows="6" name="about" required="required" Placeholder="Description"></textarea>
</br></br>

<b>Select image to upload</b> : 
<input type="file" name="photo" id="photo"/></br>
<font color="orange"><small>Image size must be smaller than 1MB</small></font>
</br></br>

<div class="textc">
<input type="text" name="feature" placeholder="Featuring..." required="required"/>
</div>

<input type="submit" class="btn2" name="mix" value="Upload"/>
</form>

<?php
if(isset($_POST["mix"])){

//Variable declaration
  $title = $_POST["title"];
  $title = addslashes($title);
  $lin = $_POST["link"];
  $about = $_POST["about"];
  $about = addslashes($about);
  $feature = $_POST["feature"];
  $feature = addslashes($feature);
  date_default_timezone_set("Africa/Lagos");
  $date = date('M d, Y');

//Image variable declaration
  $dir = "../images/";
  $file = $dir.basename($_FILES["photo"]["name"]);
  $uploadfilevalue = 1;
  $filetype = pathinfo($file.PATHINFO_EXTENSION);
  $link = "/images/".$_FILES["photo"]["name"];
  $image_name = $_FILES["photo"]["name"];

//Upload file
  move_uploaded_file($_FILES["photo"]["tmp_name"], $file);


  $insert = "INSERT INTO mix (title, link, about, thumb, feature, updated) 
  VALUES('$title', '$lin', '$about', '$link', '$feature', '$date')";

  mysql_query($insert);
  echo '<meta http-equiv="refresh" content="0, url=/admin/index.php">';
?>
<script>
    window.alert("Mixtape uploaded successfully");
</script>
<?php
}  
?>

  </p>
</div>



<!-- Upload a new video -->

<button class="accordion">Upload a new YouTube video</button>
<div class="panel">
  <p>

<form action="/admin/index.php" method = "POST">
<div class="textc">
<input type="text" name="title" placeholder="Video's title" required="required"/>
</div>

<div class="textc">
<input type="text" name="link" placeholder="Video's YouTube Link" required="required"/>
</div>

<input type="submit" class="btn2" name="vid" value="Upload"/>
</form>

<?php
if(isset($_POST["vid"])){

//Variable declaration
  $title = $_POST["title"];
  $title = addslashes($title);
  $link = $_POST["link"];
  $lin = addslashes($link);
  date_default_timezone_set("Africa/Lagos");
  $date = date('M d, Y');

  $insert = "INSERT INTO youtube (title, link) 
  VALUES('$title', '$lin')";

  mysql_query($insert) or die(mysql_error());
  echo '<meta http-equiv="refresh" content="0, url=/admin/index.php">';
?>
<script>
    window.alert("Video uploaded successfully");
</script>
<?php
}  
?>

  </p>
</div>


<!--Delete highlights -->

<button class="accordion">Delete Highlights</button>
<div class="panel">
  <p>
<?php
$sng = "SELECT * FROM highlights";
$res = mysql_query($sng);

echo "<ul>";
while($song = mysql_fetch_array($res)){
echo '<div class="del">';
 echo '<li>';
 echo '<b><h2>'.$song["txt"];
 echo "</h3></b></br>";
 echo "Added on : ".$song["updated"];
 echo '</br></br><a href="deletehigh.php?id='.$song["id"].'">Delete Highlight</a>';
 echo "</li>";
 echo '</div>';
}
echo "</ul>";
?>

  </p>
</div>


<!--Delete songs -->

<button class="accordion">Delete Songs</button>
<div class="panel">
  <p>
<?php
$sng = "SELECT * FROM song";
$res = mysql_query($sng);

echo "<ul>";
while($song = mysql_fetch_array($res)){
echo '<div class="del">';
 echo '<li>';
 echo '<b><h2>'.$song["title"];
 echo "</h3></b></br>";
 echo "Uploaded on : ".$song["updated"];
 echo '</br></br><a href="delete.php?id='.$song["id"].'">Delete Song</a>';
 echo "</li>";
 echo '</div>';
}
echo "</ul>";
?>

  </p>
</div>

<!--Delete mixtapes -->

<button class="accordion">Delete Mixtapes</button>
<div class="panel">
  <p>
<?php
$sng = "SELECT * FROM mix";
$res = mysql_query($sng);

echo "<ul>";
while($song = mysql_fetch_array($res)){
echo '<div class="del">';
 echo '<li>';
 echo '<b><h2>'.$song["title"];
 echo "</h3></b></br>";
 echo "Uploaded on : ".$song["updated"];
 echo '</br></br><a href="deletemix.php?id='.$song["id"].'">Delete Song</a>';
 echo "</li>";
 echo '</div>';
}
echo "</ul>";
?>

  </p>
</div>

<!--Delete videos -->

<button class="accordion">Delete Videos</button>
<div class="panel">
  <p>
<?php
$sng = "SELECT * FROM youtube";
$res = mysql_query($sng);

echo "<ul>";
while($song = mysql_fetch_array($res)){
echo '<div class="del">';
 echo '<li>';
 echo '<b><h2>'.$song["title"];
 echo "</h3></b></br>";
 echo '</br></br><a href="deletevid.php?id='.$song["id"].'">Delete Videos</a>';
 echo "</li>";
 echo '</div>';
}
echo "</ul>";
?>

  </p>
</div>

</center>


<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
</script>

</body>
</html>

</br></br>
<?php
include("../footer.php");
?>
</html>