<?php
use App\DatabaseController;
require_once "../app/config.php";
require_once "./includes/client.php";
require_once "./includes/admin.php";

$dc = new DatabaseController();


if (isset($_GET['id'])) {
  $stmnt = $dc->openConnection()->prepare("DELETE FROM products WHERE id = :id");
  $stmnt->bindParam(':id', $_GET['id']);
  $stmnt->execute();
  header("Location: admin_packages.php");
  exit();
}

header("Location: admin_packages.php");
exit();
