<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_GET["id"]) || empty($_GET["id"]) || !isset($_GET["value"]) || empty($_GET["value"]) || !isset($_GET["type"]) || empty($_GET["type"]) || !in_array($_GET["type"], ["size", "quantity"])) {
  die(json_encode(["success" => false]));
}



$id = $_GET["id"];
$value = $_GET["value"];
$type = $_GET["type"];
$cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];


if (!isset($cart[$id])) {
  die(json_encode(["success" => false]));
}

if ($type == "size") {
  $old = $cart[$id];
  $old["size"] = $value;
  unset($cart[$id]);
  $cart[explode("_", $id)[0] . '_' . $value] = $old;
} else {
  $cart[$id]["quantity"] = $value;
}

$_SESSION["cart"] = $cart;
die(json_encode(["success" => true]));
