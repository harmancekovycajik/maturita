<?php
use App\DatabaseController;
use App\DataController;
require_once "./app/config.php";
require_once "./app/MailController.php";
require './app/PHPMailer/Exception.php';
require './app/PHPMailer/PHPMailer.php';
require './app/PHPMailer/SMTP.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION["cart"]) || empty($_SESSION["cart"])) {
    header("Location: /");
}

$dc = new DataController();
if (isset($_SESSION["user"]) && !empty($_SESSION["user"])) {
    $user = $dc->getUser($_SESSION["user"]);
} else {
    $user = null;
}

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
    $cart = $_SESSION["cart"];
    $total = 0;
    $products = [];
    foreach ($cart as $product_id => $item) {
        $product = $db->openConnection()->prepare("SELECT * FROM products WHERE id = :id LIMIT 1");
        $product->bindParam(":id", explode("_", $product_id)[0]);
        $product->execute();
        $product = $product->fetch();
        $products[] = $product;
        $product->quantity = $item["quantity"];
        $product->size = $item["size"];
        $total += $product->price * $item["quantity"];
    }
    $shipping = 4.99;
    if ($total > 100) {
        $shipping = 0;
    }
    $final_total = $total + $shipping;
    if (isset($_SESSION['user'])) {
        $order = $db->openConnection()->prepare("INSERT INTO orders (name, surname, email, phone, country, city, address1, address2, postal, shipping, total, user_id) VALUES (:name, :surname, :email, :phone, :country, :city, :address1, :address2, :postal, :shipping, :total, :user)");
        $order->bindParam(":user", $_SESSION['user']);
    } else {
        $order = $db->openConnection()->prepare("INSERT INTO orders (name, surname, email, phone, country, city, address1, address2, postal, shipping, total) VALUES (:name, :surname, :email, :phone, :country, :city, :address1, :address2, :postal, :shipping, :total)");
    }
    $order->bindParam(":name", $name);
    $order->bindParam(":surname", $surname);
    $order->bindParam(":email", $email);
    $order->bindParam(":phone", $phone);
    $order->bindParam(":country", $country);
    $order->bindParam(":city", $city);
    $order->bindParam(":address1", $address1);
    $order->bindParam(":address2", $address2);
    $order->bindParam(":postal", $postal);
    $order->bindParam(":shipping", $shipping);
    $order->bindParam(":total", $final_total);
    $order->execute();
    $order_id = $db->openConnection()->lastInsertId();
    foreach ($products as $item) {
        $order_product = $db->openConnection()->prepare("INSERT INTO order_products (order_id, product_id, quantity, size) VALUES (:order_id, :product_id, :quantity, :size)");
        $order_product->bindParam(":order_id", $order_id);
        $order_product->bindParam(":product_id", $item->id);
        $order_product->bindParam(":quantity", $item->quantity);
        $order_product->bindParam(":size", $item->size);
        $order_product->execute();
    }
    $mail = new MailController();
    $mail->sendOrderMail($email, $name, $surname, orderData: [
        'id' => $order_id,
        'created_at' => date("Y-m-d H:i:s"),
        'phone' => $phone,
        'country' => $country,
        'city' => $city,
        'address1' => $address1,
        'address2' => $address2,
        'postal' => $postal,
        'shipping' => $shipping,
        'total' => $total,
        'final_total' => $final_total,
    ]);
    unset($_SESSION["cart"]);
    $_SESSION['order_complete'] = true;
    header("Location: /confirm.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "./includes/head.php" ?>

</head>

<body>

    <?php require_once "./includes/nav.php" ?>

    <section id="home_bar">
        <div class="nadpis_bar">
            <h2>košík</h2>
            <p>pokladňa</p>
        </div>
    </section>


    <div class="checkout_nadpis">
        <a href="kosik.php">späť do košíka</a>
        <h2>Pokladňa</h2>
    </div>
    <section id="checkout">
        <form action="" method="post" class="form">
            <div id="checkout_faktura">
                <h3>Fakturačná adresa</h3>

                <div class="line">
                    <label for="meno">Zadajte meno</label>
                    <input type="text" name="name" required placeholder="meno" value="<?= isset($user) ? $user->name : '' ?>">
                </div>

                <div class="line">
                    <label for="priezvisko">Zadajte priezvisko</label>
                    <input type="text" name="surname" required placeholder="priezvisko" value="<?= isset($user) ? $user->surname : '' ?>">
                </div>

                <div class="line">
                    <label for="email">Zadajte E-mailovú adresu</label>
                    <input type="email" name="email" required placeholder="E-mail" value="<?= isset($user) ? $user->email : '' ?>">
                </div>

                <div class="line">
                    <label for="telcislo">Zadajte Telefónne číslo</label>
                    <input type="text" name="phone" required placeholder="telefónne číslo" value="<?= isset($user) ? $user->phone : '' ?>">
                </div>

                <div class="line">
                    <label for="krajina">Vyberte krajinu</label>
                    <select id="krajiny" name="country">
                        <option disabled selected hidden>Vyberte možnosť
                        </option>
                        <option <?= $user->country == 'Slovensko' ? 'selected' : '' ?> value="Slovenko">Slovensko</option>
                        <option <?= $user->country == 'Česko' ? 'selected' : '' ?> value="Česko">Česká Republika
                        </option>
                        <option <?= $user->country == 'Maďarsko' ? 'selected' : '' ?> value="Maďarsko">Maďarsko</option>
                        <option <?= $user->country == 'Poľsko' ? 'selected' : '' ?> value="Poľsko">Poľsko</option>
                        <option <?= $user->country == 'Rakúsko' ? 'selected' : '' ?> value="Rakúsko">Rakúsko</option>
                    </select>
                </div>

                <div class="line">
                    <label for="mesto">Zadajte mesto</label>
                    <input type="text" name="city" required placeholder="mesto" value="<?= isset($user) ? $user->city : '' ?>">

                <div class="line">
                    <label for="adresa1">Zadajte 1. adresu</label>
                    <input type="text" name="address1" required placeholder="adresa 1" value="<?= isset($user) ? $user->address1 : '' ?>">
                </div>

                <div class="line">
                    <label for="adresa2">Zadajte 2. adresu (nepovinné)</label>
                    <input type="text" name="address2" placeholder="adresa 2" value="<?= isset($user) ? $user->address2 : '' ?>">
                </div>

                <div class="line">
                    <label for="psc">Zadajte PSČ</label>
                    <input type="text" name="postal" required placeholder="PSČ" value="<?= isset($user) ? $user->postal : '' ?>">
                </div>

            </div>

            <button type="submit" class="button_platba">objednať</button>
        </form>



    </section>

    <?php require_once "./includes/footer.php" ?>

</body>

</html>