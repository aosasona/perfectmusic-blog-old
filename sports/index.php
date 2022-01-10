<?php
include("../connect.php");
include("../header.php");
?>

<title>Sport News</title>
<body>
</br></br>
<center>
<?php

$sql = "SELECT * FROM news WHERE article_type='sports' ORDER BY id DESC";
$result = mysql_query($sql);

$count = mysql_num_rows($result);
if($count == 0) {
    echo "<b>No PM Lists Posts Yet.</b>";
}
else{

while($show = mysql_fetch_array($result)) {
    $title = $show["name"];
    $id = $show["id"];
    include("../url.php");

    echo '<div class="display-search"><img src="'.$show["thumb"].'" class="tabcontentimg"/>';
     echo '<b><a href="../article/?article='.$title.$id.'&id='.$show["id"].'" class="title">'.$show["name"].'</a></b></div>';
 
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