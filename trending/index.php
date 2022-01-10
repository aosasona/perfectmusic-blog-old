<?php
include("../connect.php");
include("../header.php");
?>

<title>Trending Posts</title>
<body>

<center></br>
<div class="topic-hot"><b>TRENDING POSTS</b></div>
<?php

$sql = "SELECT * FROM news ORDER BY views DESC";
$result = mysql_query($sql);
$count = mysql_num_rows($result);
if($count == 0) {
    echo "<b>No News Yet.</b>";
}
else{

while($show = mysql_fetch_array($result)) {
    $title = $show["name"];
    $id = $show["id"];
    include("../url.php");

    echo '<div class="display"><img src="'.$show["thumb"].'" class="tabcontentimg"/>';
    echo '<b><a href="/article/?article='.$title.$id.'&id='.$show["id"].'" class="title">'.$show["name"].'</a></b></div>';
}
}
?>
</center>
</body>
<?php
echo "</br></br>";
include("../footer.php");
?>