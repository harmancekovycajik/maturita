<?php
use App\DataController;
require_once "./app/config.php";


if (isset($_SESSION["user"])) {
  header("Location: client/index.php");
}

// Initialize an error message variable
$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $surname = $_POST["surname"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $passwordConfirm = $_POST["password-confirm"];

  if ($password !== $passwordConfirm) {
    $errorMessage = "Heslá sa nezhodujú";
  } else {
    $db = new DataController();
    $user = $db->getUserByEmail($email);

    if ($user) {
      $errorMessage = "Používateľ už existuje";
    } else {
      $db->registerUser($name, $surname, $email, $password);
      header("Location: login.php");
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once "./includes/head.php" ?>

</head>

<body>

  <?php require_once "./includes/nav.php" ?>

  <section id="checkout">
    <form action="" method="post" class="form">
      <div id="checkout_faktura">
        <h3>Register</h3>
        <?php if ($errorMessage): ?>
          <div class="error-message" style="color: red;">
            <?php echo htmlspecialchars($errorMessage); ?>
          </div>
        <?php endif; ?>
        <div class="line">
          <label for="name">Zadajte Meno</label>
          <input type="text" name="name" required placeholder="Meno">
        </div>
        <div class="line">
          <label for="surname">Zadajte Priezvisko</label>
          <input type="text" name="surname" required placeholder="Priezvisko">
        </div>
        <div class="line">
          <label for="email">Zadajte E-mailovú adresu</label>
          <input type="email" name="email" required placeholder="E-mail">
        </div>

        <div class="line">
          <label for="password">Zadajte Heslo</label>
          <input type="password" name="password" required placeholder="heslo">
        </div>

        <div class="line">
          <label for="password-confirm">Zadajte Heslo znovu</label>
          <input type="password" name="password-confirm" required placeholder="heslo znovu">
        </div>
      </div>
      <button type="submit" class="button_platba">registrovať sa</button>
    </form>
  </section>

  <?php require_once "./includes/footer.php" ?>

</body>

</html>