<?php
Session_start();
Session_destroy();
?>
<meta http-equiv="refresh" content="0, url=/admin/login.php">
<script>
    window.alert("Reset successful! Login now");
</script>