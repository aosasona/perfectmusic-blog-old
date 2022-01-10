<?php
include("../connect.php");
session_start();

if(isset($_POST["login"])){

    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    $sql = "SELECT * FROM artist_profile WHERE username='$username'";
    $res = mysql_query($sql) or die(mysql_error());
    $count = mysql_num_rows($res) or die(mysql_error());

    if($count > 0){

        while($select =  mysql_fetch_array($res)){

            $name = $data["name"];

            if($password == $select["pass"]){
        
                Setcookie('username', $username, time()+3600*24*14);
                Setcookie('name', $name, time()+3600*24*14);

        echo '<meta http-equiv="refresh" content="0, url=/editor/main.php">';
            }
        else {
            echo '<meta http-equiv="refresh" content="0, url=/editor/index.php">';
    ?>
    <script>
            alert("Incorrect passowrd!!");
    </script>
    <?php
            }
        }
    }
    else {
        echo '<meta http-equiv="refresh" content="0, url=/editor/index.php">';
    ?>
    <script>
        alert("User not found!!");
    </script>
    <?php
         }
    }
?>