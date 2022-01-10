<?php
include $_SERVER["DOCUMENT_ROOT"]."/php/connect.php";
include $_SERVER["DOCUMENT_ROOT"]."/php/check_login.php";
include $_SERVER["DOCUMENT_ROOT"]."/php/header.php";
?>

<!DOCTYPE html>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/home.css" type="text/css"/> 
    <meta name="author" content="Aer Info-Tech">
    <meta property="og:image" content="/images/logo.png">
    <link rel="icon" href="/images/logo.png">

    <script src="/js/navigation_show.js">
    </script>
<?php
$id = $_GET["id"];
$sql = "SELECT * FROM blog WHERE id='$id'";
$result = mysqli_query($conn, $sql);

while($data = mysqli_fetch_array($result)){
$tit = $data["name"];
$key = explode(" ", $tit);
$keyword = implode(", ", $key);

echo '<head>';
echo '<meta name="description" content="'.$data["article"].'">';
echo '<meta name="keywords" content="'.$keyword.'">';
echo '</head>';
echo '<title>'.$data["title"].'</title>';
}
?>
    </head>