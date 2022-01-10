<?php
error_reporting(-1);

session_start();

include("header.php");

include("../connect.php");

include("validate.php");
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://perfectmusic.com.ng/css/home.css" type="text/css"/>   
<link rel="stylesheet" href="/css/home.css" type="text/css"/> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">

   
<script>
    function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;
  
    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
  
    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  
    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }
  </script>
</head>
<title>PM Creators Dashboard</title>

<body>
<center>
<div class="nav">
<a href="dashboard.php#upload">Upload +</a>
<a href="dashboard.php#release">My Uploads</a>
<a href="dashboard.php#info">Sub. History</a>
<a href="/artist/signout">Log out</a>
</div>

<?php
$username = $_SESSION["username"];

$sql = "SELECT * FROM artist_profile WHERE username='$username'";
$run = mysql_query($sql) or die(mysql_error());

//MAIN PROFILE

while($profile = mysql_fetch_array($run)){
    $name = $profile["name"];
    $sel = "SELECT * FROM artist WHERE name='$name'";
    $ar = mysql_query($sel) or die(mysql_error());
    while($fetch = mysql_fetch_array($ar)){
        echo '<img src="'.$fetch["photo"].'" class="profile-img"/></br>';
    }
    echo '<h1>'.strtoupper($profile["first"]).' '.strtoupper($profile["last"]).'</h1>';
    echo '<div class="artistname">'.strtoupper($profile["name"]).'</div>';
    echo '<div class="about-main">ABOUT ME</div><div class="about">'.nl2br($profile["about"]).'</div>';

}
//ACCOUNT BALANCE
$bul = "SELECT * FROM balance WHERE username='$username'";
$query = mysql_query($bul) or die(mysql_error());

$we = "SELECT * FROM withdraw WHERE username='$username' AND status='PENDING'";
$qu = mysql_query($we);

if(mysql_num_rows($qu) < 1){
    $withdraw = "No Active Withdrawals";
}
else {
    $withdraw = "Processing withdrawal";
}

date_default_timezone_set("Africa/Lagos");
$date = date('M d, Y');
$day = date('d');

echo '<div class="about-main" id="release">PAYMENTS & WITHDRAWAL</div>';
while($bal = mysql_fetch_array($query)){
    echo '<div class="about"><div class="small">Available Balance</div>';
    echo "<h1>N".$bal["amount"]."</h1>";
    echo '<div class="small">Withdrawal Status : '.$withdraw.'</div>';

    
    if($day == "21" OR $day == "22" OR $day == "23" OR $day == "24" OR $day == "25"){
        if($bal["amount"] != "0.00"){
        echo '</br></br><form action="/artist/withdraw.php" method="post"><center>';
        echo '<button type="submit" name="withdraw" class="button-home">Withdraw All Funds</button>';
        echo '</center></form>';
        }
        else {
            echo '</br></br><center><button type="disabled" name="withdraw" class="button-disable">Withdraw All Funds</button>';
            echo '<div class="small">Insufficient funds!!</div></center>';
            }
    }else {
        echo '</br></br><center><button type="disabled" name="withdraw" class="button-disable">Withdraw All Funds</button>';
        echo '<div class="small">Withdrawals are only accepted, allowed and processed from the 21st till 25th every month, check again during these days</div></center>';
    }


    echo "</div>";
}

//MY MUSIC
    $name = strtolower($_SESSION["name"]);
    $music = "SELECT * FROM music_upload WHERE main='$name' ORDER BY id DESC";
    $query = mysql_query($music) or die(mysql_error());
    
    echo '<div class="about-main" id="release">MY MUSIC</div>';

    if(mysql_num_rows($query) < 1){
        echo "<tr>NO DATA TO SHOW</tr>";
    }
    else {
        

        echo '<div class="about"><table style="width:100%;">';
        echo '<tr><th>Title</th><th>Downloads & Streams</th><th>Date Uploaded</th><th>Category</th><th>Actions</th></tr>';
        
    while($song = mysql_fetch_array($query)){
        $title = $song["name"];
        $id = $song["id"];
        include("../url.php");
if($song["premium"] == "YES"){
    $premium = "PREMIUM";
}
else {
    $premium = "FREE";
}
    echo '<tr><td class="title">'.$song["name"].'</td>';
    echo '<td>'.$song["downloads"].'</td>';
    echo '<td>'.$song["updated"].'</td>';
    echo '<td>'.$premium.'</td>';
    echo '<td> <a href="delete.php?id='.$song["id"].'" class="action">DELETE</a> <a href="https://perfectmusic.com.ng/music/?song='.$title.$id.'&id='.$song["id"].'" class="action">VIEW</a></td></tr>';

    }
    }
    echo "</table>";
echo "</div>";

//UPLOAD A NEW SONG
?>
<div class="about-main" id="upload">UPLOAD A NEW SONG</div>
<div class="about"></br>
    Select Your Music Upload's Category : </br></br>
    <div class="tab">
  <button class="tablinks" id="default" onclick="openCity(event, 'free')"><b></br>FREE</b></button>
  <button class="tablinks" onclick="openCity(event, 'premium')"><b></br>PREMIUM</b></button>
</div>

<div id="free" class="tabcontent">
<p> </br>
<center><h1 style="color : #FC3C44;">FREE</h1></center>

<form action="/artist/free.php" method = "POST" enctype="multipart/form-data">
</br>

<div class="field">
<b>Song's Title</b></br>
    <input type="text" name="name" placeholder="Title" required="required"/>
    <div class="desc">This is the title of your song eg. I'm the one</div>
</div>
</br>

<div class="field">
<b>Artists Featured</b></br>
    <input type="text" name="feature" placeholder="Featuring..."/>
    <div class="desc">This is the name of artists featured in your song eg. Justin Bieber, Lil Wayne</div>
</div>

</br>
<div class="field">
<b>Audiomack Link</b></br>
    <input type="text" name="audiomack" placeholder="Audiomack Link"/>
    <div class="desc">This is the audiomack link to your song eg. https://audiomack.com/drakeheffernan/song/juice-wrld-bad-boy-ft-young-thug</div>
</div>
</br>
<div class="field">
<textarea name="about" required="required" Placeholder="Description/About The Song"></textarea>
</div>
</br>

<b>Select the thumbnail/music art</b> : 
<input type="file" name="thumb" id="thumb"/></br>
</br></br>

<b>Select the MP3 file you want to upload</b> : 
<input type="file" name="photo" id="photo"/></br>
</br></br>

<center>
<input type="submit" name="fetch" class="button-home" value="Upload"/>
</center>

</form>

</p>
</div>

<div id="premium" class="tabcontent">
<p> </br>
<center><h1 style="color : #FC3C44;">PREMIUM</h1></center>
<form action="/artist/premium.php" method = "POST" enctype="multipart/form-data">
</br>

<div class="field">
<b>Song's Title</b></br>
    <input type="text" name="name" placeholder="Title" required="required"/>
    <div class="desc">This is the title of your song eg. I'm the one</div>
</div>
</br>

<div class="field">
<b>Artists Featured</b></br>
    <input type="text" name="feature" placeholder="Featuring..."/>
    <div class="desc">This is the name of artists featured in your song eg. Justin Bieber, Lil Wayne</div>
</div>

</br>
<div class="field">
<b>Audiomack Link</b></br>
    <input type="text" name="audiomack" placeholder="Audiomack Link"/>
    <div class="desc">This is the audiomack link to your song eg. https://audiomack.com/drakeheffernan/song/juice-wrld-bad-boy-ft-young-thug</div>
</div>
</br>
<div class="field">
<textarea name="about" required="required" Placeholder="Description/About The Song"></textarea>
</div>
</br>

<b>Select the thumbnail/music art</b> : 
<input type="file" name="thumb" id="thumb"/></br>
</br></br>

<b>Select the MP3 file you want to upload</b> : 
<input type="file" name="photo" id="photo"/></br>
</br></br>

<center>
<input type="submit" name="fetch" class="button-home" value="Upload"/>
</center>

</form>

</p>
</div>
</div>

</center>
<div class="about-main" id="info">ACCOUNT SUBSCRIPTION HISTORY</div>
<div class="about">
<?php
//SUB HISTORY

$name = strtolower($_SESSION["username"]);
    $music = "SELECT * FROM sub_history WHERE username='$username' ORDER BY id DESC";
    $query = mysql_query($music) or die(mysql_error());


    if(mysql_num_rows($query) < 1){
        echo "</br><tr>NO DATA TO SHOW</tr></br>";
    }
    else {
    
        echo '</br></br><table style="width:100%;">';
        echo '<tr><th>Subscription Plan</th><th>Transaction ID</th><th>Plan Status</th><th>Transaction Date</th><th>Due Date</th></tr>';
        
        while($sub = mysql_fetch_array($query)){

        echo '<tr><td class="title">'.$sub["plan"].'</td>';
        echo '<td>'.$sub["txn_id"].'</td>';
        echo '<td>'.$sub["validity"].'</td>';
        echo '<td>'.$sub["sub_start"].'</td>';
        echo '<td>'.$sub["sub_end"].'</td></tr>';
        }
        echo "</table>";
    }
?>
</div>

</br>
<script>
    document.getElementById("default").click();
</script>

</body>

</br></br>
<?php 
include("footer.php");
?>
</br></br></br>
</html>