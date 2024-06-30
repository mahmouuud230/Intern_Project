<?php
include_once("authentication.php");

if (isset($_POST['logout_btn'])) {
    unset($_SESSION['auth']);
    unset($_SESSION['auth_role']);
    unset($_SESSION['auth_user']);
    $_SESSION['message'] = "Logged Out Successfully";
    header('location: login.php');
    exit(0);

    session_destroy();
}
