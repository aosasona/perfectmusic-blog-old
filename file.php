<?php
include("connect.php");
include("header.php");
?>

<title>PerfectMusic - Other Files</title>
<head>
        <link rel="stylesheet" href="/css/search.css" type="text/css"/> 
</head>

<body>

</br>
<center>
<?php

$sql = "SELECT * FROM files ORDER BY id DESC";
$result = mysql_query($sql);

$count = mysql_num_rows($result);
if($count == 0) {

    echo "<b>No files yet.</b>";

}
else{
while($show = mysql_fetch_array($result)) {
    $title = $show["name"];
    $id = $show["id"];
    include("url.php");

    echo '<div class="display-search"><img src="'.$show["thumb"].'" class="tabcontentimg"/>';
    echo '<b><a href="/file/?article='.$title.$id.'&id='.$show["id"].'" class="title">'.$show["name"].'</a></b></div>';

}
}

?>
</center>
</br>
</body>
</html>
</br></br></br>
<?php
include("footer.php");
?>