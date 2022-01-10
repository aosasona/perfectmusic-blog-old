<?php
if(isset($_POST["trans"])){
    $type = $_POST["type"];
    $amount = $_POST["amount"];

echo '<meta http-equiv="refresh" content="0, url="https://wa.me/2348139285896?text=Hello%20I%20want%20to%20'.$type.'%20N'.$amount.'%20worth%20of%20BTC">';
exit();
}
?>