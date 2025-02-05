<?php
use App\DataController;
require_once "../app/config.php";
require_once "./includes/client.php";
require_once "./includes/admin.php";
$page = "admin";

$dc = new DataController();


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
        <h3>Eshop stats</h3>
      </div>
      <div class="page-content">
        <section class="row">
          <div class="col-12 col-lg-9">
            <div class="row">
              <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                  <div class="card-body px-4 py-4-5">
                    <div class="row">
                      <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                        <div class="stats-icon purple mb-2">
                          <i class="iconly-boldActivity"></i>
                        </div>
                      </div>
                      <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                        <h6 class="text-muted font-semibold">Orders</h6>
                        <h6 class="font-extrabold mb-0"><?= $dc->countAllOrders() ?></h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                  <div class="card-body px-4 py-4-5">
                    <div class="row">
                      <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                        <div class="stats-icon blue mb-2">
                          <i class="iconly-boldWork"></i>
                        </div>
                      </div>
                      <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                        <h6 class="text-muted font-semibold">Total spent</h6>
                        <h6 class="font-extrabold mb-0"><?= $dc->countAllSpent() ?>€</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                  <div class="card-body px-4 py-4-5">
                    <div class="row">
                      <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                        <div class="stats-icon blue mb-2">
                          <i class="iconly-boldUser"></i>
                        </div>
                      </div>
                      <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                        <h6 class="text-muted font-semibold">Users</h6>
                        <h6 class="font-extrabold mb-0"><?= $dc->countAllUsers() ?></h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                  <div class="card-body px-4 py-4-5">
                    <div class="row">
                      <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                        <div class="stats-icon blue mb-2">
                          <i class="iconly-boldBox"></i>
                        </div>
                      </div>
                      <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                        <h6 class="text-muted font-semibold">Products</h6>
                        <h6 class="font-extrabold mb-0"><?= $dc->countAllProducts() ?></h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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