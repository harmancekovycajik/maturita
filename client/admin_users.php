<?php
use App\DataController;
require_once "../app/config.php";
require_once "./includes/client.php";
require_once "./includes/admin.php";
$page = "admin_users";

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
        <h3>Users</h3>
      </div>
      <div class="page-content">
        <section class="section">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">
                All users
              </h5>
            </div>
            <div class="card-body">
              <table class="table table-striped" id="table1">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Admin</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Orders</th>
                    <th>Spen</th>
                    <th>Created at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($dc->getAllUsersWithStats() as $user): ?>
                    <tr>
                      <td><?= $user->id ?></td>
                      <td>
                        <?php if (!empty($user->is_admin)): ?>
                          <span class="badge bg-danger">admin</span>
                        <?php else: ?>
                          <span class="badge bg-success">user</span>
                        <?php endif; ?>
                      </td>
                      <td><a href="./admin_edit_user.php?id=<?= $user->id ?>"><?= $user->email ?></a></td>
                      <td><?= $user->name ?>   <?= $user->surname ?></td>
                      <td>
                        <?= $user->address1 ?><br>
                        <?= $user->city ?>, <?= $user->postal ?><br>
                        <?= $user->country ?>
                      </td>
                      <td><?= $user->orders ?></td>
                      <td><?= $user->spent ?>€</td>
                      <td><?= date("d.m.Y H:i", strtotime($user->created_at)) ?></td>
                      <td>
                        <a href="./admin_delete_user.php?id=<?= $user->id ?>" class="btn btn-sm btn-danger">Delete</a>
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