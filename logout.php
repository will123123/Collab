<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the home page or any other page after logout
header("Location: homepage.php"); // Change 'index.php' to your desired home page URL
exit;
?>
