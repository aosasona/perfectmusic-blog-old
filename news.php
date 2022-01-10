<?php
include("connect.php");
include("header.php");
?>

<title>PerfectMusic - News</title>
<head>
        <link rel="stylesheet" href="/css/search.css" type="text/css"/> 
</head>
<body>

</br>

<?php

$sql = "SELECT * FROM news ORDER BY id DESC";
$result = mysql_query($sql);

$count = mysql_num_rows($result);
if($count == 0) {

    echo "<b>No News Articles Yet.</b>";

}
else{
while($show = mysql_fetch_array($result)) {

    $title = $show["name"];
    $id = $show["id"];
    include("url.php");
    if(strlen($show["name"]) > 100){
        $name = substr($show["name"], 0, 90).'... (READ MORE)';
    }
    else {
        $name = $show["name"];
    }

    echo '<div class="display-search"><img src="'.$show["thumb"].'" class="tabcontentimg"/>';
    echo '<b><a href="/article/?article='.$title.$id.'&id='.$show["id"].'" class="title">'.$name.'</a></b></div>';

}
}

?>

</br>

<?php
include("footer.php");
?>