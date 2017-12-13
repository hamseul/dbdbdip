<?php session_start(); ?>
<?php
session_destroy();

echo "<script>location.replace('index.php')</script>";

?>
