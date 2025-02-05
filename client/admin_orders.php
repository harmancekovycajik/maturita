<?php
use App\DataController;
require_once "../app/config.php";
require_once "./includes/client.php";
require_once "./includes/admin.php";
$page = "admin_orders";

$dc = new DataController();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once "./includes/head.php"; ?>
  <link rel="stylesheet" crossorigin href="./assets/compiled/css/table-datatable.css">
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
        <h3>Orders</h3>
      </div>
      <div class="page-content">
        <section class="section">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">
                All orders
              </h5>
            </div>
            <div class="card-body">
              <table class="table table-striped" id="table1">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Customer</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Total</th>
                    <th>Created at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($dc->getAllOrders() as $order): ?>
                    <tr>
                      <td><?= $order->id ?></td>
                      <td>
                        <?php if (!empty($order->user_id)): ?>
                          <span class="badge bg-success">customer</span>
                        <?php else: ?>
                          <span class="badge bg-danger">foreigner</span>
                        <?php endif; ?>
                      </td>
                      <td><?= $order->email ?></td>
                      <td><?= $order->name ?>   <?= $order->surname ?></td>
                      <td>
                        <?= $order->address1 ?><br>
                        <?= $order->city ?>, <?= $order->postal ?><br>
                        <?= $order->country ?>
                      </td>
                      <td><?= $order->total ?>€</td>
                      <td><?= date("d.m.Y H:i", strtotime($order->created_at)) ?></td>
                      <td>
                        <a href="view_order.php?id=<?= $order->id ?>" class="btn btn-sm btn-primary">View</a>
                      </td>
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
  <script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
  <script src="assets/static/js/pages/simple-datatables.js"></script>



</body>

</html>