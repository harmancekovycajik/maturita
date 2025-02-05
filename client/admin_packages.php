<?php
use App\DataController;
require_once "../app/config.php";
require_once "./includes/client.php";
require_once "./includes/admin.php";
$page = "admin_products";

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
        <h3>Products</h3>
      </div>
      <div class="page-content">
        <section class="section">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">
                All products
              </h5>
            </div>
            <div class="card-body">
              <table class="table table-striped" id="table1">
                <thead>
                  <tr>
                    <th>#</th>
                    <th></th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Has size</th>
                    <th>Created at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($dc->getAllProducts() as $product): ?>
                    <tr>
                      <td><?= $product->id ?></td>
                      <td>
                        <img src="../images/shop/<?= $product->image ?>" alt="<?= $product->name ?>" class="img-fluid"
                          style="max-width: 80px; height: 80px; object-fit: contain;">
                      </td>
                      <td><?= $product->name ?></td>
                      <td><?= $product->price ?>€</td>
                      <td>
                        <span class="badge bg-info"><?= $product->category ?></span>
                      </td>
                      <td>
                        <?php if ($product->has_size): ?>
                          <span class="badge bg-success">yes</span>
                        <?php else: ?>
                          <span class="badge bg-danger">no</span>
                        <?php endif; ?>
                      </td>

                      <td><?= date("d.m.Y H:i", strtotime($product->created_at)) ?></td>
                      <td>
                        <a href="admin_edit_package.php?id=<?= $product->id ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="admin_delete_package.php?id=<?= $product->id ?>" class="btn btn-sm btn-danger">Delete</a>
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