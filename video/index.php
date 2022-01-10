<?php
include("../connect.php");
include("../header.php");
?>

<?php
$id = $_GET["id"];
$sql = "SELECT * FROM video_upload WHERE id='$id'";
$result = mysql_query($sql);

while($data = mysql_fetch_array($result)){
    $tit = $data["name"];
    $key = explode(" ", $tit);
    $keyword = implode(", ", $key);

echo '<head>';
echo '<meta name="description" content="'.$data["name"].'">';
echo '<meta name="keywords" content="'.$keyword.'">';
echo '</head>';
echo '<title>'.$data["name"].'</title>';
}
?>
<html>
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
$sql = "SELECT * FROM video_upload WHERE id='$id'";
$result = mysql_query($sql);
echo "<center>";
while($data = mysql_fetch_array($result)){
    
    echo '</br></br><video width="320" height="240" controls><source src="'.$data["link"].'" type="video/mp4">Your browser does not support the video tag.
  </video></br></br></br><h7><b>'.$data["name"].'</b></h7></br></br>';
    echo '<div class="article">';
    echo '<div class="text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    echo nl2br($data["about"]);
    echo "</div></div></br></br>";
?>
   <a class="btn-ghost" href="<?php echo $data["link"]; ?>"  rel="noopener" onclick="javascript:window.open('<?php echo $data['link']; ?>'); return false;" download>DOWNLOAD</a>
</br></br></br>
  <?php 
      $title = $data["name"];
      $id = $data["id"];
      include("../url.php");
      $name = $data["name"];

      $url1 = $name.' : https://perfectmusic.com.ng/video/?article='.$title.$id.'&id='.$id;
      $none = 'https://perfectmusic.com.ng/video/?article='.$title.$id.'&id='.$id;
      $urlnew = rawurlencode($url1);
      $url2 = rawurlencode($none);

      session_start();
      $_SESSION["url"] = 'index.php/?article='.$title.$id.'&id='.$id;
      $_SESSION["id"] = $_GET["id"];

?> 

<div class="share">
<b><center>
<a href=<?php echo '"https://api.whatsapp.com/send?text='.$urlnew.'" data-action="share/whatsapp/share"><img src="../images/whatsapp-share.png" class="share-icon"/>'; ?></a>
<a href=<?php echo '"https://www.facebook.com/sharer/sharer.php?u='.$url2.'" target="_blank"><img src="../images/facebook-share.png" class="share-icon"/>'; ?></a>
<a href=<?php echo '"http://twitter.com/share?text=Hey!+Check+this+out&url='.$url2.'" target="_blank"><img src="../images/twitter-share.png" class="share-icon"/>'; ?></a>
</center></b>
</div>


<?php
$type = "video";
$_SESSION["section"] = $type;
?>


<div class="comm">
<form action="/video/query.php" method="POST">
<h6>What do you think about this?</h6></br>
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
$category = "video";


//Check if log already exists in database
$chk = "SELECT * FROM visit_log WHERE ip='$current_ip' AND category='$category' AND fileid='$id'";
$chkres = mysql_query($chk);
$count = mysql_num_rows($chkres);

if($count < 1) {

    $views = $data["downloads"];
    $newv = $views + 1;
    $up = "UPDATE video_upload SET downloads='$newv' WHERE id='$id'";
    mysql_query("$up");
    echo "</center>";

    include("../log.php");
}
}
?>

</br></br></br>
</html>
<?php
include("../footer.php");
?>