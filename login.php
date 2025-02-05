<?php
use App\DataController;
require_once "./app/config.php";

if (isset($_SESSION["user"])) {
  header("Location: client/index.php");
  exit(); // Always exit after a header redirect
}

// Initialize an error message variable
$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $db = new DataController();
  $user = $db->getUserByEmail($email);

  if ($user) {
    if (password_verify($password, $user->password)) {
      $_SESSION["user"] = $user->id;
      header("Location: client/index.php");
      exit(); // Always exit after a header redirect
    } else {
      $errorMessage = "Nesprávne heslo"; // Incorrect password
    }
  } else {
    $errorMessage = "Používateľ neexistuje"; // User does not exist
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
        <h3>Login</h3>
        <?php if ($errorMessage): ?>
          <div class="error-message" style="color: red;">
            <?php echo htmlspecialchars($errorMessage); ?>
          </div>
        <?php endif; ?>
        <div class="line">
          <label for="email">Zadajte E-mailovú adresu</label>
          <input type="email" name="email" required placeholder="E-mail">
        </div>

        <div class="line">
          <label for="password">Zadajte Heslo</label>
          <input type="password" name="password" required placeholder="heslo">
        </div>
      </div>
      <button type="submit" class="button_platba">prihlásiť</button>
      <div class="checkout_nadpis">
      <a href="register.php">registrovať</a>
      </div>
    </form>
  </section>

  <?php require_once "./includes/footer.php" ?>

</body>

</html>