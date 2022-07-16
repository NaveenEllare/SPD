<?php
session_start();
unset($_SESSION['user_login']);
unset($_SESSION['name']);
header('location:../client_login.php');
die();
?>