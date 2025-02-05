<?php
use App\DatabaseController;
require_once "./app/config.php";

if (!isset($_GET['p']) || empty($_GET['p'])) {
  header("Location: /");
  die();
}
$slug = $_GET["p"];
$db = new DatabaseController();
$product = $db->openConnection()->prepare("SELECT * FROM products WHERE slug = :slug LIMIT 1");
$product->bindParam(":slug", $slug);
$product->execute();
$product = $product->fetch();

$recommended = $db->openConnection()->prepare("SELECT * FROM product_selection INNER JOIN products ON products.id = product_selection.product_id WHERE type = 'recommended'");
$recommended->execute();
$recommended = $recommended->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["product_id"]) && isset($_POST["quantity"])) {
    $product_id = $_POST["product_id"];
    $quantity = $_POST["quantity"];
    $size = isset($_POST["size"]) ? $_POST["size"] : null;
    $cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];
    if (isset($cart[$product_id . '_' . $size])) {
      $cart[$product_id]["quantity"] += $quantity;
    } else {
      $cart[$product_id . '_' . $size] = [
        "quantity" => $quantity,
        "size" => $size
      ];
    }
    $_SESSION["cart"] = $cart;
    //$message = "Produkt bol pridaný do košíka";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once "./includes/head.php" ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
</head>

<body>

  <?php require_once "./includes/nav.php" ?>

  <section id="produkt-detaily" class="section1">
    <div class="single-produkt-img">
      <a href="images/shop/<?= $product->image ?>" data-fancybox data-caption="<?= $product->name ?>"><img
          src="images/shop/<?= $product->image ?>" width="100%" id="hlavny-img" alt="<?= $product->name ?>"></a>
    </div>

    <div class="single-produkt-detaily">
      <?php if (isset($message)): ?>
        <div class="message"><?= $message ?></div>
      <?php endif; ?>
      <h4 class="produkt-popis"><?= $product->name ?></h4>
      <h5><?= $product->price ?>&euro;</h5>
      <form action="" method="POST">
        <input type="hidden" name="product_id" value="<?= $product->id ?>">
        <?php if ($product->has_size == 1): ?>
          <div class="select">
            <select name="size">
              <option value="S">S</option>
              <option value="M">M</option>
              <option value="L">L</option>
              <option value="XL">XL</option>
            </select>
          </div>
        <?php endif; ?>
        <div class="input">
          <input type="number" min="1" name="quantity" value="1">
        </div>
        <button>pridať do košíka</button>
      </form>


      <h4>detaily produktu</h4>
      <span><?= $product->description ?></span>
    </div>
  </section>

  <section id="hlavny-produkt" class="section1">
    <h4 class="snadpis">odporúčané produkty</h4>
    <div id="recommended" class="produkt-kontainer swiper">
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-wrapper">
        <?php foreach ($recommended as $row): ?>
          <div class="produkt swiper-slide">
            <a href="produkt.php?p=<?= $row->slug ?>"><img src="images/shop/<?= $row->image ?>"
                alt="<?= $row->name ?>" /></a>
            <div class="popis">
              <h6><?= $row->name ?></h6>
              <h5><?= $row->price ?>&euro;</h5>
            </div>
          </div>
        <?php endforeach; ?>


      </div>
    </div>
  </section>

  <?php require_once "./includes/footer.php" ?>
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    Fancybox.bind("[data-fancybox]", {
      // Your custom options
    });
    const recommended = new Swiper("#recommended", {
      // Optional parameters
      direction: "horizontal",
      loop: true,
      slidesPerView: 4,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  </script>
</body>



</html>