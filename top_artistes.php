<?php

$tak = "SELECT * FROM artist WHERE position='1' OR position='2' OR position='3' OR position='4' OR position='5' OR position='6' OR position='7' OR position='8' OR position='9' OR position='10'ORDER BY position ASC LIMIT 10";
$sel = mysql_query($tak);
$num = mysql_num_rows($sel);

if($num > 0){

while ($view = mysql_fetch_array($sel)){
$na = $view["name"];
$artname = StrToUpper($na);

echo '<div class="artist">';
echo '<b><div class="artists">'.$artname.'</div></b>';
echo '<a href="artist.php?name='.$view["name"].'"><img src="'.$view["photo"].'" class="artist"></a>';
echo '</div>';
}
} else {
    echo "<small><center><b>No TOP artistes to display</b></center></small></br></br>";
}
?>