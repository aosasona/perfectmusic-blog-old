<?php
//fetch connection data and page header
include("../connect.php");
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://perfectmusic.com.ng/css/premium.css" type="text/css"/>   
<link rel="stylesheet" href="/css/premium.css" type="text/css"/> 

<style>
    body {
        margin-top : 1%;
    }
</style>
</head>

<title>Search results for <?php echo $_GET["query"]; ?> | PM Store</title>

<body>
<b><div class="resulthead">Search results for <i><?php echo $_GET["query"]; ?></i></div></b>
</br>
<center>
<?php
$query = $_GET["query"]; 
$min_length = 2;

if(strlen($query) >= $min_length){ 

// Changes characters used in html to their equivalents
$query = htmlspecialchars($query); 

// Prevents SQL injection
    $query = mysql_real_escape_string($query);

    // The SQL syntax for the music database search
    $raw_results = mysql_query("SELECT * FROM music_upload WHERE (`name` LIKE '%".$query."%') OR (`about` LIKE '%".$query."%')  AND premium='NO' AND visible='ON' ORDER BY id DESC") or die(mysql_error());

    if(mysql_num_rows($raw_results) > 0){

        while($show = mysql_fetch_array($raw_results)){
            $title = $show["name"];
            $id = $show["id"];
            include("../url.php");

            if(strlen($show["name"]) > 40){
                $name = substr($show["name"], 0, 38).'...';
            }
            else {
                $name = $show["name"];
            }

            echo '<img src="'.$show["thumb"].'" class="tabcontentimg"/><div class="display-music">';
            echo '<b><a href="/premium/display.php?article='.$title.$id.'&id='.$show["id"].'" class="title">'.$name.'</a></b></div>';
        
            
        }
        
    }
}
    ?>
    
    </center>
    </br></br></br>
    <?php
    include("footer.php");
    ?>