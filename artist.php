<?php
include("connect.php");
include("header.php");

$name = $_GET["name"];
?>
<html>
<head><link rel="stylesheet" href="/css/search.css" type="text/css"/>

<style>
.about {
    margin-left : 1.5%;
    margin-right : 1.5%;
}
.about small {
    font-size : 78%;
    font-weight : 520;
    color : black;
}
</style>
 </head>
<title><?php echo strtoupper($name); ?> - Artiste Page</title>

<body>
<div class="about">
</br>

<?php
$name = $_GET["name"];
$sql = "SELECT * FROM music_upload WHERE main='$name' AND visible='ON' AND premium='NO'";
$result = mysql_query($sql);

$count = mysql_num_rows($result);
if($count == 0) {

    echo "<b>No Free Songs Yet.</b>";

}
else{
    $p = "SELECT * FROM artist WHERE name='$name'";
    $run = mysql_query($p);

    while($pick = mysql_fetch_array($run)){
        if($pick["verify"] == "YES"){
            $verify = '<img src="/images/verify.png" class="verify"/>';

            $ast =  "SELECT * FROM artist_profile WHERE name='$name'";
            $rem = mysql_query($ast);

            while($ab = mysql_fetch_array($rem)){
                $aboutme = $ab["about"];
            }
        }
        else {
            $verify = "<i><small>(Unverified)</small></i>";
        }
        echo '</br></br><center><img src="'.$pick["photo"].'" class="artist-profile"></br></br>';
        echo '<b><font color="black"><h1>'.strToUpper($pick["name"]).' '.$verify.'</h1></font></b></center></br>';

        if($pick["verify"] == "YES"){

            $ast =  "SELECT * FROM artist_profile WHERE name='$name'";
            $rem = mysql_query($ast) or die(mysql_error());

            while($ab = mysql_fetch_array($rem)){
        
        echo '<small>'.nl2br($ab["about"]).'</small></br></br></br>';
            }

            //SHOW PREMIUM SONGS
            
$sqlp = "SELECT * FROM music_upload WHERE main='$name' AND visible='ON' AND premium='YES'";
$resultp = mysql_query($sqlp);

$countp = mysql_num_rows($resultp);
if($countp == 0) {

    echo "<b>No Premium Songs Yet.</b>";

}
else{
echo '<b><big>Premium Songs &#128071;</big></b></br></br>';

while($show = mysql_fetch_array($resultp)) {

    $title = $show["name"];
    $id = $show["id"];
    include("url.php");

    echo '<div class="display-search"><img src="'.$show["thumb"].'" class="tabcontentimg"/>';
    echo '<b><a href="/premium/display.php?article='.$title.$id.'&id='.$show["id"].'" class="title">'.$show["name"].'</a></b></div>';

}
echo "</br></br>";
}
        }
        echo '<b><big>Free Songs &#128071;</big></b></br></br>';
    }

//SHOW FREE SONGS
while($show = mysql_fetch_array($result)) {

    $title = $show["name"];
    $id = $show["id"];
    include("url.php");

    echo '<div class="display-search"><img src="'.$show["thumb"].'" class="tabcontentimg"/>';
    echo '<b><a href="/music/?article='.$title.$id.'&id='.$show["id"].'" class="title">'.$show["name"].'</a></b></div>';

}
}

?>
</div>
</body>
</br>
</html>
<?php
include("footer.php");
?>