<?php 

include 'includes/auth.inc.php';
include 'includes/allfunctions.inc.php';

session_unset();

session_destroy();
header('Location: login.php');
?>