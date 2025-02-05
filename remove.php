<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_GET["id"]) || empty($_GET["id"])) {
  header("Location: /");
}

$id = $_GET["id"];
$cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];
unset($cart[$id]);
$_SESSION["cart"] = $cart;
header("Location: /kosik.php");
die();
