<?php
include("connect.php");
include("header.php");
include("cron.php");
?>
<html>
<head>
    <style>
.displayp {

    width: 97%;
    height: 78px;
    background: inherit;
    padding: 0px;
    padding-top: 15px;
    padding-bottom: 0px;
    padding-left: 5px;
    text-align: left;
    margin-bottom: 3px;
    border-bottom: 1.7px solid #646464;
    font-size: 80%;
    margin-top: 0px;
    display: block;
    word-wrap: break-word;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

.displayp a {
    color: black;
    text-decoration: none;
}

.displayp a:hover {
    color: #000966;
}
.displaym {

    width: 97%;
    height: 75px;
    background: inherit;
    padding: 0px;
    padding-top: 15px;
    padding-bottom: 2px;
    padding-left: 5px;
    text-align: left;
    margin-bottom: 3px;
    border-bottom: 1.7px solid #646464;
    font-size: 80%;
    margin-top: 0px;
    display: block;
    word-wrap: break-word;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

.displaym a {
    color: black;
    text-decoration: none;
}

.displaym a:hover {
    color: #000966;
}
    </style>
<script>
    function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;
  
    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
  
    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  
    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }
  </script>
  
  <meta name="description" content="Welcome to PerfectMusic, home of unlimited entertainment, gists, music, videos and even files. Owned by Ayomide Animasaun AKA DJ Rado. Don't forget to subscribe!">
</head>

<title>Latest Nigerian Music, News & Videos - PerfectMusic</title>

<body>

</br>
<div class="tab">
  <button class="tablinks" id="default" onclick="openCity(event, 'trending')"><b>&#128293;</br>TRENDING</b></button>
  <button class="tablinks" onclick="openCity(event, 'latest')"><b>&#9200;</br>LATEST</b></button>
  <button class="tablinks" onclick="openCity(event, 'new')"><b>&#127925;</br>NEW SONGS</b></button>
</div>

</br>
<center>
<!-- TRENDING -->
<div id="trending" class="tabcontent">
<p>  
<?php

$sql = "SELECT * FROM news ORDER BY views DESC LIMIT 30";
$result = mysql_query($sql);
$count = mysql_num_rows($result);
if($count == 0) {
    echo "<b>No News Yet.</b>";
}
else{

while($show = mysql_fetch_array($result)) {
    $title = $show["name"];
    $id = $show["id"];
    include("url.php");

    if(strlen($show["name"]) > 100){
        $name = substr($show["name"], 0, 90).'... (READ MORE)';
    }
    else {
        $name = $show["name"];
    }
    echo '<img src="'.$show["thumb"].'" class="tabcontentimg"/><div class="displayp">';
    echo '<b><a href="/article/?article='.$title.$id.'&id='.$show["id"].'" class="title">'.$name.'</a></b></div>';
}
}
?>
<form action="/trending" method="post">
<button type="submit" class="more2"><b>CLICK HERE TO SEE MORE TRENDING POSTS &rarr;</b></button>
</form>
<?php
echo '</div>';
?>

</p>
</div>
</center>

<center>
<!-- LATEST -->
<div id="latest" class="tabcontent">
<p>  

<?php

$sql = "SELECT * FROM news ORDER BY id DESC LIMIT 30";
$result = mysql_query($sql);

$count = mysql_num_rows($result);
if($count == 0) {
    echo "<b>No News Yet.</b>";
}
else{

while($show = mysql_fetch_array($result)) {
    $title = $show["name"];
    $id = $show["id"];
    include("url.php");
    if(strlen($show["name"]) > 100){
        $name = substr($show["name"], 0, 90).'... (READ MORE)';
    }
    else {
        $name = $show["name"];
    }

    echo '<img src="'.$show["thumb"].'" class="tabcontentimg"/><div class="displayp">';
     echo '<b><a href="/article/?article='.$title.$id.'&id='.$show["id"].'" class="title">'.$name.'</a></b></div>';
 
}
}
echo '</div>';
?>
</p>
</div>
</center>

<center>
<!-- NEW MUSIC -->
<div id="new" class="tabcontent">
<p>  
<?php

$sql = "SELECT * FROM music_upload WHERE visible='ON' AND premium='NO' ORDER BY id DESC LIMIT 30";
$result = mysql_query($sql);

$count = mysql_num_rows($result);
if($count == 0) {

    echo "<b>No Music Files Yet.</b>";

}
else{
while($show = mysql_fetch_array($result)) {
    $title = $show["name"];
    $id = $show["id"];
    include("url.php");
    if(strlen($show["name"]) > 100){
        $name = substr($show["name"], 0, 90).'...';
    }
    else {
        $name = $show["name"];
    }
    echo '<img src="'.$show["thumb"].'" class="tabcontentimg"/><div class="displaym">';
    echo '<b><a href="/music/?article='.$title.$id.'&id='.$show["id"].'" class="title">'.$name.'</a></b></div>';

}
}
echo '</div></center>';
?>
</p>
</div>
</center>

<center>
<div class="topic"><b>HOTTEST SONGS</b></div>
<?php

$sql = "SELECT * FROM music_upload WHERE visible='ON' AND premium='NO' ORDER BY downloads DESC LIMIT 20";
$result = mysql_query($sql);

$count = mysql_num_rows($result);
if($count == 0) {

    echo "<b>No Music Files Yet.</b>";

}
else{
while($show = mysql_fetch_array($result)) {
    $title = $show["name"];
    $id = $show["id"];
    include("url.php");
    if(strlen($show["name"]) > 100){
        $name = substr($show["name"], 0, 90).'...';
    }
    else {
        $name = $show["name"];
    }
    echo '<img src="'.$show["thumb"].'" class="tabcontentimg"/><div class="displayp">';
    echo '<b><a href="/music/?article='.$title.$id.'&id='.$show["id"].'" class="title">'.$name.'</a></b></div>';

}
}
echo '</div>';
?>
<form action="/hot-songs" method="post">
<button type="submit" class="more1"><b>SEE MORE HOTTEST SONGS &rarr;</b></button>
</form>
</center>

<center>
<div class="topic-hot"><b>NEW POSTS</b></div>

<?php

$sql = "SELECT * FROM news ORDER BY id DESC LIMIT 60";
$result = mysql_query($sql);

$count = mysql_num_rows($result);
if($count == 0) {
    echo "<b>No News Yet.</b>";
}
else{

while($show = mysql_fetch_array($result)) {
    $title = $show["name"];
    $id = $show["id"];
    include("url.php");
    if(strlen($show["name"]) > 100){
        $name = substr($show["name"], 0, 90).'... (READ MORE)';
    }
    else {
        $name = $show["name"];
    }
    echo '<img src="'.$show["thumb"].'" class="tabcontentimg"/><div class="displayp">';
    echo '<b><a href="/article/?article='.$title.$id.'&id='.$show["id"].'" class="title">'.$name.'</a></b></div>';
 
}
}
echo '</div>';
?>
</center>

</br>
<h2>TOP ARTISTES</h2>
<center>
<div class="topart">

<?php include("top_artistes.php"); ?>   

</div>
</center>

</br></br>

<div class="full">
<form action="search.php" method="GET" id="searchform">
    <center>
        <b><small>Looking for something? Search below &#8595</small></b>
<div class="search">
    <input type="text" name="query" placeholder="Search On PerfectMusic..." minlength="3" required="required"/>
    <input type="submit" class="button" name="search" value="GO"/>
</div>
</center>
</form>


<script>
    document.getElementById("default").click();
    </script>
</body>
</html>
<?php
echo "</br></br>";
include("footer.php");
?>