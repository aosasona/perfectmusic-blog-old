<?php
include("connect.php");
include("header.php");
?>

<title>PerfectMusic - Videos</title>
<head>
        <link rel="stylesheet" href="/css/search.css" type="text/css"/> 
</head>
<body>

</br>

<?php

$sql = "SELECT * FROM video_upload ORDER BY id DESC";
$result = mysql_query($sql);

$count = mysql_num_rows($result);
if($count == 0) {

    echo "<b>No Videos Yet.</b>";

}
else{
while($show = mysql_fetch_array($result)) {

    $title = $show["name"];
    $id = $show["id"];
       include("url.php");

    echo '<div class="display-search">';
    echo '<b><a href="/video/?article='.$title.$id.'&id='.$show["id"].'" class="title">'.$show["name"].'</a></b></div>';

}
}

?>

</br>

<?php
include("footer.php");
?>