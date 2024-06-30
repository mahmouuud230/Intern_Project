<?php
// print_r($_POST);
//error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!(isset($_SESSION['auth']))) {
  $_SESSION['message'] = "Login to access Dashboard";
  header('location: auth/login.php');
  exit(0);
}
