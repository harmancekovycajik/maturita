<div id="sidebar">
  <div class="sidebar-wrapper active">
    <div class="sidebar-header position-relative">
      <div class="d-flex justify-content-between align-items-center">
        <div class="logo">
          <a href="./">La Flame Wear</a>
        </div>
        <div class="sidebar-toggler  x">
          <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
        </div>
      </div>
    </div>
    <div class="d-flex flex-column align-items-center justify-content-center">
      <p class="fs-4 fw-semibold"><?= $user->name ?> <?= $user->surname ?></p>
      <?php if ($user->is_admin == 1): ?>
        <span class="badge bg-danger">ADMIN</span>
      <?php endif; ?>
    </div>
    <div class="sidebar-menu">
      <ul class="menu">
        <li class="sidebar-title">Menu</li>

        <li class="sidebar-item <?= $page == 'dashboard' ? 'active' : '' ?>">
          <a href="./" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="sidebar-item ">
          <a href="/" class='sidebar-link'>
            <i class="bi bi-house-fill"></i>
            <span>Home</span>
          </a>
        </li>
        <li class="sidebar-item <?= $page == 'profile' ? 'active' : '' ?>">
          <a href="./profile.php" class='sidebar-link'>
            <i class="bi bi-gear-fill"></i>
            <span>Profile</span>
          </a>
        </li>
        <li class="sidebar-item <?= $page == 'orders' ? 'active' : '' ?>">
          <a href="./orders.php" class='sidebar-link'>
            <i class="bi bi-cart-fill"></i>
            <span>Orders</span>
          </a>
        </li>


        <?php if ($user->is_admin == 1): ?>
          <li class="sidebar-title">Admin</li>
          <li class="sidebar-item <?= $page == 'admin' ? 'active' : '' ?>">
            <a href="./admin.php" class='sidebar-link'>
              <i class="bi bi-graph-up"></i>
              <span>Overview</span>
            </a>
          </li>
          <li class="sidebar-item  has-sub <?= $page == 'admin_products' ? 'active' : '' ?>">
            <a href="#" class='sidebar-link'>
              <i class="bi bi-box-fill"></i>
              <span>Products</span>
            </a>
            <ul class="submenu ">
              <li class="submenu-item  ">
                <a href="./admin_packages.php" class="submenu-link">Products</a>
              </li>
              <li class="submenu-item  ">
                <a href="./admin_create_package.php" class="submenu-link">Create Product</a>
              </li>
            </ul>
          </li>
          <li class="sidebar-item <?= $page == 'admin_orders' ? 'active' : '' ?>">
            <a href="./admin_orders.php" class='sidebar-link'>
              <i class="bi bi-cart-fill"></i>
              <span>All orders</span>
            </a>
          </li>
          <li class="sidebar-item <?= $page == 'admin_users' ? 'active' : '' ?>">
            <a href="./admin_users.php" class='sidebar-link'>
              <i class="bi bi-people-fill"></i>
              <span>Users</span>
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</div>