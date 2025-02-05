<?php
use App\DataController;
use App\DatabaseController;
require_once "../app/config.php";
require_once "./includes/client.php";
$page = "profile";

$dc = new DataController();


//handle post
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (!isset($_POST['name']) || empty($_POST['name']) || !isset($_POST['surname']) || empty($_POST['surname']) || !isset($_POST['email']) || empty($_POST['email']) || !isset($_POST['phone']) || empty($_POST['phone']) || !isset($_POST['country']) || empty($_POST['country']) || !isset($_POST['city']) || empty($_POST['city']) || !isset($_POST['address1']) || empty($_POST['address1']) || !isset($_POST['postal']) || empty($_POST['postal'])) {
    die("Všetky polia musia byť vyplnené");
  }

  $db = new DatabaseController();
  $name = $_POST["name"];
  $surname = $_POST["surname"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $country = $_POST["country"];
  $city = $_POST["city"];
  $address1 = $_POST["address1"];
  $address2 = $_POST["address2"] ?? null;
  $postal = $_POST["postal"];
  $db->openConnection()->prepare("UPDATE users SET name = :name, surname = :surname, email = :email, phone = :phone, country = :country, city = :city, address1 = :address1, address2 = :address2, postal = :postal WHERE id = :id")->execute(['name' => $name, 'surname' => $surname, 'email' => $email, 'phone' => $phone, 'country' => $country, 'city' => $city, 'address1' => $address1, 'address2' => $address2, 'postal' => $postal, 'id' => $user->id]);
  header("Location: ./profile.php");
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
        <h3>Profile</h3>
      </div>
      <div class="page-content">
        <section class="row">
          <div class="col-12 col-lg-9">
            <div class="row">
              <div class="col-12 ">
                <div class="card">
                  <div class="card-body">
                    <form action="" method="post">
                      <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Your Name"
                          value="<?= $user->name ?>">
                      </div>

                      <div class="form-group">
                        <label for="surname" class="form-label">Surname</label>
                        <input type="text" name="surname" id="surname" class="form-control" placeholder="Your Surname"
                          value="<?= $user->surname ?>">
                      </div>
                      <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Your Email"
                          value="<?= $user->email ?>">
                      </div>
                      <div class="form-group">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Your Phone"
                          value="<?= $user->phone ?>">
                      </div>
                      <div class="form-group mt-4">
                        <label for="city" class="form-label">City</label>
                        <input type="text" name="city" id="city" class="form-control" placeholder="Your City"
                          value="<?= $user->city ?>">
                      </div>
                      <div class="form-group mt-4">
                        <label for="address1" class="form-label">Adress 1</label>
                        <input type="text" name="address1" id="address1" class="form-control"
                          placeholder="Your Address 1" value="<?= $user->address1 ?>">
                      </div>
                      <div class="form-group mt-4">
                        <label for="address2" class="form-label">Adress 2</label>
                        <input type="text" name="address2" id="address2" class="form-control"
                          placeholder="Your Address 2" value="<?= $user->address2 ?>">
                      </div>
                      <div class="form-group mt-4">
                        <label for="postal" class="form-label">Postal</label>
                        <input type="text" name="postal" id="postal" class="form-control" placeholder="Your Postal"
                          value="<?= $user->postal ?>">
                      </div>

                      <div class="form-group">
                        <label for="country" class="form-label">Country</label>
                        <select name="country" id="country" class="form-control">
                          <option disabled selected hidden>Vyberte možnosť
                          </option>

                          <?= $user->country ?>
                          <option <?= $user->country == 'Slovensko' ? 'selected' : '' ?> value="Slovensko">
                            Slovesnko
                          </option>
                          <option <?= $user->country == 'Česko' ? 'selected' : '' ?> value="Česko">Česká Republika
                          </option>
                          <option <?= $user->country == 'Maďarsko' ? 'selected' : '' ?> value="Maďarsko">Maďarsko</option>
                          <option <?= $user->country == 'Poľsko' ? 'selected' : '' ?> value="Poľsko">Poľsko</option>
                          <option <?= $user->country == 'Rakúsko' ? 'selected' : '' ?> value="Rakúsko">Rakúsko</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <button type="submit" value="basic" class="btn btn-primary">Save Changes</button>
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


</body>

</html>