<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION["user"])) {
  header("Location: login.php");
  exit(); // Always exit after a header redirect
}
unset($_SESSION['user']);
header("Location: login.php");