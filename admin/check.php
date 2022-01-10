<?php
echo $_COOKIE["log"];

if(isset($_COOKIE["log"])){
    echo "SET";
}
else {
    echo "Cookie not set";
}
?>