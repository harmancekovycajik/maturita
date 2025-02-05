<?php
use App\DataController;
require_once "../app/config.php";
require_once "./includes/client.php";
$page = "orders";

$dc = new DataController();

if (isset($_GET['id'])) {
  $order = $dc->getOrder($_GET['id']);
  if ($user->is_admin == 0 && $order->user_id != $user->id) {
    header("Location: ./orders.php");
  }
} else {
  header("Location: ./orders.php");
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once "./includes/head.php"; ?>
</head>

<body>
  <script src="assets/static/js/initTheme.js"></script>
  <div id="app">
    <?php require_once "./includes/sidebar.php"; ?>
    <div id="main">
      <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
          <i class="bi bi-justify fs-3"></i>
        </a>
      </header>

      <div class="page-heading">
        <h3>Order </h3>
      </div>
      <div class="page-content">
        <section class="row">
          <div class="card">
            <div class="card-content">
              <div class="card-body">
                <div class="row">
                  <div class="col-12 col-md-6">
                    <h5>Order Details</h5>
                    <p><strong>Order ID:</strong> <?= $order->id ?></p>
                    <p>Order Total: <?= $order->total ?>€</p>
                    <p>Order Date: <?= date('d.m.Y H:i', strtotime($order->created_at)) ?></p>
                    <h5>Customer Details</h5>
                    <p>Customer Name: <?= $order->name ?></p>
                    <p>Customer Email: <?= $order->email ?></p>
                    <p>Customer Phone: <?= $order->phone ?></p>
                    <p>Customer Address: <?= $order->address1 ?> |
                      <?= $order->city ?>, <?= $order->postal ?> |
                      <?= $order->country ?> |
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section class="row">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">
                Products in Order
              </h5>
            </div>
            <div class="card-body">
              <table class="table table-striped" id="table1">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($dc->getProductsInOrder($order->id) as $product): ?>
                    <tr>
                      <td><?= $product->id ?></td>
                      <td>
                        <img src="../images/shop/<?= $product->image ?>" alt="<?= $product->name ?>" class="img-fluid"
                          style="max-width: 80px; height: 80px; object-fit: contain;">
                      </td>
                      <td><?= $product->name ?></td>
                      <td><?= $product->price ?>€</td>
                      <td><?= $product->size ?></td>
                      <td><?= $product->quantity ?></td>
                      <td><?= $product->price * $product->quantity ?>€</td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>

          </div>
        </section>


      </div>

      <?php require_once "./includes/footer.php"; ?>
    </div>
  </div>

  <?php require_once "./includes/scripts.php"; ?>


</body>

</html>