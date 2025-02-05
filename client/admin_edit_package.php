<?php
use App\DataController;
use App\DatabaseController;
require_once "../app/config.php";
require_once "./includes/client.php";
require_once "./includes/admin.php";
$page = "admin_products";

$dc = new DataController();

if (isset($_GET['id'])) {
  $product = $dc->getProduct($_GET['id']);
} else {
  header("Location: ./admin_packages.php");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $description = $_POST['description'];
  $category = $_POST['category'];
  $has_size = $_POST['has_size'];

  if (isset($_FILES['image'])) {
    unlink("../images/shop/" . $product->image);
    $image = $_FILES['image'];
    $image_name = $dc->uploadImage($image);
  } else {
    $image_name = $product->image;
  }

  $stmnt = $dc->openConnection()->prepare("UPDATE products SET name = :name, price = :price, description = :description, image = :image, category = :category, has_size = :has_size WHERE id = :id");
  $stmnt->bindParam(':name', $name);
  $stmnt->bindParam(':price', $price);
  $stmnt->bindParam(':description', $description);
  $stmnt->bindParam(':image', $image_name);
  $stmnt->bindParam(':category', $category);
  $stmnt->bindParam(':has_size', $has_size);
  $stmnt->bindParam(':id', $product->id);
  $stmnt->execute();
  header("Location: admin_packages.php");
  exit();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once "./includes/head.php"; ?>
  <link rel="stylesheet" href="assets/extensions/filepond/filepond.css">
  <link rel="stylesheet" href="assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
  <link rel="stylesheet" href="assets/extensions/toastify-js/src/toastify.css">
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
        <h3>Create new product</h3>
      </div>
      <div class="page-content">
        <section class="row">
          <div class="col-12 col-lg-9">
            <div class="row">
              <div class="col-12 ">
                <div class="card">
                  <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Product name"
                          value="<?= $product->name ?>">
                      </div>

                      <div class="form-group">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" name="price" min="1" id="price" class="form-control"
                          placeholder="Product price" value="<?= $product->price ?>">
                      </div>

                      <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control"
                          placeholder="Product description"><?= $product->description ?></textarea>
                      </div>
                      <div class="form-group">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" id="image" class="image-preview-filepond">

                      </div>

                      <div class=" form-group">
                        <label for="category" class="form-label">Category</label>
                        <select name="category" id="category" class="form-control">
                          <option disabled selected hidden>Vyberte možnosť
                          </option>
                          <option <?= $product->category == 'vinyl' ? 'selected' : '' ?> value="vinyl">vinyl</option>
                          <option <?= $product->category == 'cd' ? 'selected' : '' ?> value="cd">cd</option>
                          <option <?= $product->category == 'tricko' ? 'selected' : '' ?> value="tricko">tricko</option>
                          <option <?= $product->category == 'mikina' ? 'selected' : '' ?> value="mikina">mikina</option>
                        </select>
                      </div>
                      <div class="form-group mt-4">
                        <label for="has_size" class="form-label">Has Size</label>
                        <select name="has_size" id="has_size" class="form-control">
                          </option>
                          <option <?= $product->has_size ? 'selected' : '' ?> value="1">Yes</option>
                          <option <?= $product->has_size ? '' : 'selected' ?> value="0">No</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <button type="submit" value="basic" class="btn btn-primary">Create</button>
                      </div>
                    </form>
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
  <script src="assets/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js"></script>
  <script src="assets/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js"></script>
  <script src="assets/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js"></script>
  <script
    src="assets/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js"></script>
  <script src="assets/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js"></script>
  <script src="assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js"></script>
  <script src="assets/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js"></script>
  <script src="assets/extensions/filepond/filepond.js"></script>
  <script src="assets/extensions/toastify-js/src/toastify.js"></script>
  <script src="assets/static/js/pages/filepond.js"></script>


</body>

</html>