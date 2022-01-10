<?php
include("../connect.php");
include("../header.php");
?>
<?php
$id = $_GET["id"];
$sql = "SELECT * FROM news WHERE id='$id'";
$result = mysql_query($sql);

while($data = mysql_fetch_array($result)){
$tit = $data["name"];
$key = explode(" ", $tit);
$keyword = implode(", ", $key);

echo '<head>';
echo '<meta name="description" content="'.$data["article"].'">';
echo '<meta name="keywords" content="'.$keyword.'">';
echo '</head>';
echo '<title>'.$data["name"].'</title>';
}
?>

<html>
<head>
        <link rel="stylesheet" href="/css/search.css" type="text/css"/> 
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
$sql = "SELECT * FROM news WHERE id='$id'";
$result = mysql_query($sql);

while($data = mysql_fetch_array($result)){
if(empty($data["author"]) OR $data["author"] == "NULL" OR $data["author"] == ' '){
    $username = "ADMIN";
}
else {   
    $username = strToUpper($data["author"]);
}
    echo '<h2><b>'.$data["name"].'</b></h2></br>';
    echo '<div class="small">Posted </b> by <font color="green"><b>'.$username.'</b></font> on <b>'.$data["updated"].'</b></div></br></br>';
    echo '<center><img src="'.$data["thumb"].'" class="disa"/></center></br>';
    echo '<center>';
    echo '<div class="article">';
    echo '<div class="text">';
    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    echo nl2br($data["article"]);
    echo '</br></br>';
    if(strToLower(substr($data["thumb2"], -3)) == "mp4" OR strToLower(substr($data["thumb2"], -3)) == "avi" OR strToLower(substr($data["thumb2"], -3)) == "mov") {
        echo '</br><center><video width="320" height="240" controls><source src="'.$data["thumb2"].'" type="video/mp4">Your browser does not support the video tag.
        </video></center></br>';
    } else {
    if($data["thumb2"] != "https://godaddypmusic.com/upload/" AND $data["thumb2"] != "https://perfectmusic.com.ng/upload/"){
         echo '</br><center><img src="'.$data["thumb2"].'" class="disa"/></center></br>';
    }
}
    if($data["thumb3"] != "https://godaddypmusic.com/upload/" AND $data["thumb3"] != "https://perfectmusic.com.ng/upload/"){
    echo '</br><center><img src="'.$data["thumb3"].'" class="disa"/></center></br>';
    }
    if($data["thumb4"] != "https://godaddypmusic.com/upload/" AND $data["thumb4"] != "https://perfectmusic.com.ng/upload/"){
    echo '</br><center><img src="'.$data["thumb4"].'" class="disa"/></center></br>';
    }
    if($data["thumb5"] != "https://godaddypmusic.com/upload/" AND $data["thumb5"] != "https://perfectmusic.com.ng/upload/"){
        echo '</br><center><img src="'.$data["thumb5"].'" class="disa"/></center></br>';
    }
    echo "</div></div></br></br>";

    ?>
    
<?php 
      $title = $data["name"];
      $id = $data["id"];
      
      include("../url.php");
      $name = $data["name"];

      $url1 = $name.' : https://perfectmusic.com.ng/article/?article='.$title.$id.'&id='.$id;
      $none = 'https://perfectmusic.com.ng/article/?article='.$title.$id.'&id='.$id;
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

</br></br>
<a href="https://wa.me/2348067829109"><img src="../images/tv.png" class="tv"/></a>
</br></br></br>
<div class="foryou"><b>You Might Also Like &#128071;</b></div>
</br>
<?php
$sql = "SELECT * FROM news ORDER BY RAND() LIMIT 10";
$result = mysql_query($sql);

while($show = mysql_fetch_array($result)) {

    $title = $show["name"];
    $id = $show["id"];
    include("../url.php");
    if(strlen($show["name"]) > 100){
        $name = substr($show["name"], 0, 90).'... (READ MORE)';
    }
    else {
        $name = $show["name"];
    }

    echo '<div class="display-search"><img src="'.$show["thumb"].'" class="tabcontentimg"/>';
    echo '<b><a href="../article/?article='.$title.$id.'&id='.$show["id"].'" class="title">'.$name.'</a></b></div>';


}

?>

<?php
$type = "news";
$_SESSION["section"] = $type;
?>


<div class="comm">
<form action="/article/query.php" method="POST">
<h6>What do you think about this? Let us know down below!</h6></br>
<input type="hidden" name="art_id" value=<?php echo '"'.$_SESSION["id"].'"'; ?>/>
<input type="hidden" name="cat" value=<?php echo '"'.$_SESSION["section"].'"'; ?>/>

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
$category = "news";


//Check if log already exists in database
$chk = "SELECT * FROM visit_log WHERE ip='$current_ip' AND category='$category' AND fileid='$id'";
$chkres = mysql_query($chk);
$count = mysql_num_rows($chkres);

if($count < 1) {

    $views = $data["views"];
    $newv = $views + 1;
    $up = "UPDATE news SET views='$newv' WHERE id='$id'";
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