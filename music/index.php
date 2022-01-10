<?php
include("../connect.php");
include("../header.php");
?>
<html>
<?php
$id = $_GET["id"];
$sql = "SELECT * FROM music_upload WHERE id='$id' AND visible='ON' AND premium='NO'";
$result = mysql_query($sql);

while($data = mysql_fetch_array($result)){
$tit = $data["name"];
$key = explode(" ", $tit);
$keyword = implode(", ", $key);

echo '<head>';
echo '<meta name="description" content="'.$data["about"].'">';
echo '<meta name="keywords" content="'.$keyword.'">';
echo '</head>';
echo '<title>[MUSIC] '.$data["name"].' - '.strToUpper($data["main"]).'</title>';
}
?>

<head>
        <link rel="stylesheet" href="../css/main.css" type="text/css"/> 
        
<style>
    html{
        margin : 0;
        padding : 0;
        overflow-x : hidden;
    }
</style>
</head>
<body>

</br>

<?php
$id = $_GET["id"];
$sql = "SELECT * FROM music_upload WHERE id='$id' AND visible='ON'  AND premium='NO'";
$result = mysql_query($sql);

while($data = mysql_fetch_array($result)){
    if($data["author"] != NULL){
        $username = strToUpper($data["author"]);
    }
    else {
        $username = "ADMIN";
    }
    echo "<center>";
    echo '<img src="'.$data["thumb"].'" class="dis"/></br></br></center>';
    echo '<h7><b>[MUSIC] '.strToUpper($data["main"]).' - '.$data["name"].'</b></h7></br>';
    echo '<div class="small">Posted </b> by <font color="green"><b>'.$username.'</b></font> on <b>'.$data["updated"].'</b></div></br>';
    if($data["feature"] != NULL){
        echo "</B></br><b>Featuring :</b> ".$data["feature"]."</br>";
    }
    echo '</br><center><div class="article">';
    echo '<div class="text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    echo nl2br($data["about"]);
    echo '</br></br></br><b>MORE SONGS BY : <font color="green"><a href="../artist.php?name='.$data["main"].'">'.strToUpper($data["main"]).'</a></font></b>';
    echo "</div></div></br></br>";
 ?>   
    <a href="<?php echo $data['audiomack']; ?>"><b>STREAM ON AUDIOMACK</b></a></br></br>
    <a class="btn-ghost" href="<?php echo $data["link"]; ?>"  rel="noopener" onclick="javascript:window.open('<?php echo $data['link']; ?>'); return false;" download>DOWNLOAD MP3</a>
</br></br>
    <?php 
      $title = $data["name"];
      $id = $data["id"];
      include("../url.php");
      $name = $data["name"];

      $url1 = $name.' : https://perfectmusic.com.ng/music/?article='.$title.$id.'&id='.$id;
      $none = 'https://perfectmusic.com.ng/music/?article='.$title.$id.'&id='.$id;
      $urlnew = rawurlencode($url1);
      $url2 = rawurlencode($none);

      session_start();
      $_SESSION["url"] = 'index.php/?article='.$title.$id.'&id='.$id;
      $_SESSION["id"] = $_GET["id"];

?> 
</br>

<div class="share">
<b><center>
<a href=<?php echo '"https://api.whatsapp.com/send?text='.$urlnew.'" data-action="share/whatsapp/share"><img src="../images/whatsapp-share.png" class="share-icon"/>'; ?></a>
<a href=<?php echo '"https://www.facebook.com/sharer/sharer.php?u='.$url2.'" target="_blank"><img src="../images/facebook-share.png" class="share-icon"/>'; ?></a>
<a href=<?php echo '"http://twitter.com/share?text=Hey!+Check+this+out&url='.$url2.'" target="_blank"><img src="../images/twitter-share.png" class="share-icon"/>'; ?></a>
</center></b>
</div>

</br>
<a class="download-song-bar" href="https://www.perfectmusic.com.ng/promote" target="_blank" rel="noopener noreferrer"><img src="https://www.naijaloaded.com.ng/wp-content/uploads/upload-32.png">Upload your Song</a>
</br></br></br>

<div class="more2"><b>RECOMMENDATIONS FOR YOU</b></div>
</br>
<?php
$sql = "SELECT * FROM music_upload WHERE visible='ON' AND premium='NO' ORDER BY RAND() LIMIT 10";
$result = mysql_query($sql);

while($show = mysql_fetch_array($result)) {

    $title = $show["name"];
    $id = $show["id"];
    include("../url.php");


    echo '<div class="display-search"><img src="'.$show["thumb"].'" class="tabcontentimg"/>';
    echo '<b><a href="../music/?article='.$title.$id.'&id='.$show["id"].'" class="title">'.$show["name"].'</a></b></div>';


}

?>

</center>

<?php
$type = "music";
$_SESSION["section"] = $type;
?>


<div class="comm">
<form action="/music/query.php" method="POST">
<h6>What do you think about this song? Let us know down below!</h6></br>
<div class="input-group">
<input type="text" name="user" placeholder="Name"/>
</div>
<input type="hidden" name="id" value=<?php echo '"'.$_SESSION["section"].'"'; ?> />
<textarea  name="text" required="required" placeholder="Your comment..."></textarea></br>
<input type="submit" name="comment" class="butt" value="POST"/>
</form></div>

<?php
$id = $_SESSION["id"];
$section = $_SESSION["section"];
$com = "SELECT * FROM comment WHERE article_id='$id' AND category='$section'";
$comres = mysql_query($com);
echo "</br><h2>Comments</h2>";
if(mysql_num_rows($comres) == 0){
    echo "No comments on this post yet!";
}
else {
    while($fetch = mysql_fetch_array($comres)){
    echo '<center><div class="comment">';
    echo "<i>".$fetch["user"]."</i></br></br>";
    echo "<b>".$fetch["comment"]."</b></br>";
    echo '<div class="date">'.$fetch["updated"].'</div>';
    echo '</div></center></br>';
    }
}
?>



<?php
$current_ip = $_SERVER['REMOTE_ADDR'];
$category = "music";


//Check if log already exists in database
$chk = "SELECT * FROM visit_log WHERE ip='$current_ip' AND category='$category' AND fileid='$id'";
$chkres = mysql_query($chk);
$count = mysql_num_rows($chkres);

if($count < 1) {

    $download = $data["downloads"];
    $newd = $download + 1;

    $up = "UPDATE music_upload SET downloads='$newd' WHERE id='$id'";
    mysql_query("$up");

    echo "</center>";

    include("../log.php");
}

}
?>

</br></br></br>
</body>
</html>
<?php
include("../footer.php");
?>