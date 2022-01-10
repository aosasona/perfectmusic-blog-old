<?php
include("../connect.php");
include("../header.php");
?>

<title>Hottest Songs</title>
<body>

<center></br>
<div class="topic"><b>HOTTEST SONGS</b></div>

<?php

$sql = "SELECT * FROM music_upload ORDER BY downloads DESC LIMIT 20";
$result = mysql_query($sql);

$count = mysql_num_rows($result);
if($count == 0) {

    echo "<b>No Music Files Yet.</b>";

}
else{
while($show = mysql_fetch_array($result)) {
    $title = $show["name"];
    $id = $show["id"];
    include("../url.php");

    echo '<div class="display-search"><img src="'.$show["thumb"].'" class="tabcontentimg"/>';
    echo '<b><a href="/music/?article='.$title.$id.'&id='.$show["id"].'" class="title">'.$show["name"].'</a></b></div>';

}
}
echo '</div>';
?>
</center>
</body>
<?php
echo "</br></br>";
include("../footer.php");
?>