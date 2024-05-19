<?php
session_start();

// Check if the user is logged in
$is_logged_in = isset($_SESSION["user_id"]);

// Check user role
$user_role = isset($_SESSION["role"]) ? $_SESSION["role"] : "";

// Function to display login status
function display_login_status() {
    global $is_logged_in;
    if ($is_logged_in) {
        echo '<div style="float: right;">Logged in</div>';
    } else {
        echo '<div style="float: right;">Not logged in</div>';
    }
}

// Function to check if the user has the required role
function check_role($role) {
    global $user_role;
    return $user_role === $role;
}
?>
