<?php
include("connect.php");
include("header.php");
?>

<title>PerfectMusic - Music Releases</title>
<head>
        <link rel="stylesheet" href="/css/search.css" type="text/css"/> 
</head>

<body>

</br></br></br>
<center>
    <div class="music-cont">

<div class="topic"><b>HOTTEST SONGS</b></div>

<?php

$sql = "SELECT * FROM music_upload WHERE visible='ON' AND premium='NO' ORDER BY downloads DESC LIMIT 30";
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
    echo '<div class="display-music"><img src="'.$show["thumb"].'" class="tabcontentimg"/>';
    echo '<b><a href="/music/?article='.$title.$id.'&id='.$show["id"].'" class="title">'.$name.'</a></b></div>';

}
}

?>
<form action="/hot-songs" method="post">
<button type="submit" class="more1"><b>SEE MORE HOTTEST SONGS &rarr;</b></button>
</form>
</center>
</br></br>
</div>

</br>
<h2>TOP ARTISTES</h2>
<center>
<div class="topart">

<?php include("top_artistes.php"); ?>   

</div>

</br>
<a class="download-song-bar" href="https://www.perfectmusic.com.ng/promote" target="_blank" rel="noopener noreferrer"><img src="https://www.naijaloaded.com.ng/wp-content/uploads/upload-32.png">Upload your Song</a>
</br>
</center>
</br></br>

<center>
<div class="music-cont">

<div class="topic-hot"><b>NEW SONGS</b></div>
<?php

$sql = "SELECT * FROM music_upload  WHERE visible='ON' AND premium='NO' ORDER BY id DESC";
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
    echo '<div class="display-music"><img src="'.$show["thumb"].'" class="tabcontentimg"/>';
    echo '<b><a href="/music/?article='.$title.$id.'&id='.$show["id"].'" class="title">'.$name.'</a></b></div>';
        

}
}
?>
</div>
</center>
</br>

<?php
include("footer.php");
?>