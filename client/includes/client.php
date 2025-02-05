<?php
use App\DataController;

if (!isset($_SESSION["user"])) {
  header("Location: login.php");
  exit();
}
$dc = new DataController();
$user = $dc->getUser($_SESSION["user"]);