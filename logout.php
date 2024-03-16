
<?php
session_start();
session_destroy();
header("location: /sagar-services/admin/login.php");
?>