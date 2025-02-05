<?php
namespace App;

use App\DatabaseController;


class DataController extends DatabaseController
{

  public function getUserByEmail($email)
  {
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $this->openConnection()->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();
    return $user;
  }

  public function getUser($id)
  {
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $this->openConnection()->prepare($sql);
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch();
    return $user;
  }

  public function countUserOrders($id)
  {
    $sql = "SELECT COUNT(*) FROM orders WHERE user_id = :id";
    $stmt = $this->openConnection()->prepare($sql);
    $stmt->execute(['id' => $id]);
    $count = $stmt->fetchColumn();
    return $count;
  }

  public function countUserSpent($id)
  {
    $sql = "SELECT SUM(total) FROM orders WHERE user_id = :id";
    $stmt = $this->openConnection()->prepare($sql);
    $stmt->execute(['id' => $id]);
    $spent = $stmt->fetchColumn();
    return $spent ?? 0;
  }

  public function getUserOrders($id)
  {
    $sql = "SELECT * FROM orders WHERE user_id = :id ORDER BY created_at DESC";
    $stmt = $this->openConnection()->prepare($sql);
    $stmt->execute(['id' => $id]);
    $orders = $stmt->fetchAll();
    return $orders;
  }

  public function registerUser($name, $surname, $email, $password)
  {
    $sql = "INSERT INTO users (name, surname, email, password) VALUES (:name, :surname, :email, :password)";
    $stmt = $this->openConnection()->prepare($sql);
    $stmt->execute(['name' => $name, 'surname' => $surname, 'email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT)]);
  }

  public function getAllOrders()
  {
    $sql = "SELECT * FROM orders  ORDER BY created_at DESC";
    $stmt = $this->openConnection()->prepare($sql);
    $stmt->execute();
    $orders = $stmt->fetchAll();
    return $orders;
  }

  public function getOrder($id)
  {
    $sql = "SELECT * FROM orders WHERE id = :id";
    $stmt = $this->openConnection()->prepare($sql);
    $stmt->execute(['id' => $id]);
    $order = $stmt->fetch();
    return $order;
  }

  public function getProductsInOrder($order_id)
  {
    $sql = "SELECT products.*, order_products.quantity, order_products.size FROM products JOIN order_products ON products.id = order_products.product_id WHERE order_products.order_id = :order_id";
    $stmt = $this->openConnection()->prepare($sql);
    $stmt->execute(['order_id' => $order_id]);
    $products = $stmt->fetchAll();
    return $products;
  }

  public function getAllUsers()
  {
    $sql = "SELECT * FROM users";
    $stmt = $this->openConnection()->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll();
    return $users;
  }

  public function getAllUsersWithStats()
  {
    $sql = "SELECT users.*, (SELECT COUNT(*) FROM orders WHERE user_id = users.id) as orders, (SELECT SUM(total) FROM orders WHERE user_id = users.id) as spent FROM users";
    $stmt = $this->openConnection()->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll();
    return $users;
  }

  public function getAllProducts()
  {
    $sql = "SELECT * FROM products";
    $stmt = $this->openConnection()->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll();
    return $products;
  }

  public function countAllUsers()
  {
    $sql = "SELECT COUNT(*) FROM users";
    $stmt = $this->openConnection()->prepare($sql);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    return $count;
  }

  public function countAllSpent()
  {
    $sql = "SELECT SUM(total) FROM orders";
    $stmt = $this->openConnection()->prepare($sql);
    $stmt->execute();
    $spent = $stmt->fetchColumn();
    return $spent ?? 0;
  }

  public function countAllOrders()
  {
    $sql = "SELECT COUNT(*) FROM orders";
    $stmt = $this->openConnection()->prepare($sql);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    return $count;
  }

  public function countAllProducts()
  {
    $sql = "SELECT COUNT(*) FROM products";
    $stmt = $this->openConnection()->prepare($sql);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    return $count;
  }


  public function createProduct($name, $price, $category, $description, $has_size, $image)
  {
    $slug = strtolower(str_replace(' ', '-', $name));
    $sql = "INSERT INTO products (name, price, category, has_size, image, description, slug) VALUES (:name, :price, :category, :has_size, :image, :description, :slug)";
    $stmt = $this->openConnection()->prepare($sql);
    $stmt->execute(['name' => $name, 'price' => $price, 'category' => $category, 'has_size' => intval($has_size), 'image' => $image, 'description' => $description, 'slug' => $slug]);
  }

  public function getProduct($id)
  {
    $sql = "SELECT * FROM products WHERE id = :id";
    $stmt = $this->openConnection()->prepare($sql);
    $stmt->execute(['id' => $id]);
    $product = $stmt->fetch();
    return $product;
  }

  public function uploadImage($image)
  {
    if (!getimagesize($image["tmp_name"])) {
      return null;
    }
    $target_dir = "../images/shop/";
    $target_file = $target_dir . basename($image["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $new_name = uniqid() . '.' . $imageFileType;
    $target_file = $target_dir . $new_name;
    move_uploaded_file($image["tmp_name"], $target_file);
    return $new_name;
  }
}