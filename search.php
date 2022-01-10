<?php
//fetch connection data and page header
include("connect.php");
include("header.php");
?>

<html>
<head>
        <link rel="stylesheet" href="/css/search.css" type="text/css"/> 
</head>

<title>Search results for <?php echo $_GET["query"]; ?> | PerfectMusic</title>

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


// The SQL syntax for the news database search
$raw_result = mysql_query("SELECT * FROM news WHERE (`name` LIKE '%".$query."%') OR (`article` LIKE '%".$query."%') ORDER BY id DESC") or die(mysql_error());

if(mysql_num_rows($raw_result) > 0){

    while($show = mysql_fetch_array($raw_result)){
        $title = $show["name"];
        $id = $show["id"];
        include("url.php");

        if(strlen($show["name"]) > 100){
            $name = substr($show["name"], 0, 95).'...';
        }
        else {
            $name = $show["name"];
        }
    
        echo '<div class="display-search"><img src="'.$show["thumb"].'" class="tabcontentimg"/>';
        echo '<b><a href="/article/?article='.$title.$id.'&id='.$show["id"].'" class="title">'.$name.'</a></b></div>';
    }
}


// The SQL syntax for the music database search
    $raw_results = mysql_query("SELECT * FROM music_upload WHERE (`name` LIKE '%".$query."%') OR (`about` LIKE '%".$query."%')  AND premium='NO' AND visible='ON' ORDER BY id DESC") or die(mysql_error());

    if(mysql_num_rows($raw_results) > 0){

        while($show = mysql_fetch_array($raw_results)){
            $title = $show["name"];
            $id = $show["id"];
            include("url.php");

            if(strlen($show["name"]) > 100){
                $name = substr($show["name"], 0, 95).'...';
            }
            else {
                $name = $show["name"];
            }

            echo '<div class="display-search"><img src="'.$show["thumb"].'" class="tabcontentimg"/>';
            echo '<b><a href="/music/?article='.$title.$id.'&id='.$show["id"].'" class="title">[MUSIC] '.$name.'</a></b></div>';
        
            
        }
        
    }

   
// The SQL syntax for the videos database search
$raw_re = mysql_query("SELECT * FROM video_upload WHERE (`name` LIKE '%".$query."%') OR (`about` LIKE '%".$query."%') ORDER BY id DESC") or die(mysql_error());

if(mysql_num_rows($raw_re) > 0){

    while($show = mysql_fetch_array($raw_re)){
        $title = $show["name"];
        $id = $show["id"];
        include("url.php");
        if(strlen($show["name"]) > 100){
            $name = substr($show["name"], 0, 95).'...';
        }
        else {
            $name = $show["name"];
        }

        echo '<div class="display-search">';
        echo '<b><a href="/video/?article='.$title.$id.'&id='.$show["id"].'" class="title">[VIDEO] '.$name.'</a></b></div>';
        
    }
    
}

       
// The SQL syntax for the files database search
$raw_resul = mysql_query("SELECT * FROM files WHERE (`name` LIKE '%".$query."%') OR (`about` LIKE '%".$query."%') ORDER BY id DESC") or die(mysql_error());

if(mysql_num_rows($raw_resul) > 0){

    while($show = mysql_fetch_array($raw_resul)){
        $title = $show["name"];
        $id = $show["id"];
        include("url.php");
        if(strlen($show["name"]) > 100){
            $name = substr($show["name"], 0, 95).'...';
        }
        else {
            $name = $show["name"];
        }

        echo '<div class="display-search"><img src="'.$show["thumb"].'" class="tabcontentimg"/>';
        echo '<b><a href="/file/?article='.$title.$id.'&id='.$show["id"].'" class="title">[FILE] '.$name.'</a></b></div>';
    }
}
}
?>
</center>
</br></br></br>
<?php
include("footer.php");
?>