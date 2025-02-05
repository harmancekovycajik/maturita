<?php
use App\DatabaseController;

require_once "./app/DatabaseController.php";


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$db = new DatabaseController();
$cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];
$products = [];
$total = 0;
foreach ($cart as $product_id => $item) {
    $product = $db->openConnection()->prepare("SELECT * FROM products WHERE id = :id LIMIT 1");
    $product->bindParam(":id", $product_id);
    $product->execute();
    $product = $product->fetch();
    $product->quantity = $item["quantity"];
    $product->size = $item["size"];
    $products[] = $product;
    $total += $product->price * $item["quantity"];
}
$shipping = 4.99;
if ($total > 100) {
    $shipping = 0;
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
            <p>obsah košíka</p>
        </div>
    </section>

    <section id="kosik_id" class="section1">
        <div class="kosik_background">
            <table>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td class="kosik_remove">
                                <a href="remove.php?id=<?= $product->id ?>_<?= $product->size ?>">x</a>
                            </td>
                            <td><a href="produkt.php?p=<?= $product->slug ?>"><img
                                        src="images/shop/<?= $product->image ?>"></a></td>
                            <td class="kosik_name"><a href="produkt.php?p=<?= $product->slug ?>"><?= $product->name ?></a>
                            </td>
                            <td>
                                <div class="kosik_input">
                                    <input type="number" data-input min="1"
                                        data-cart-id="<?= $product->id ?>_<?= $product->size ?>"
                                        value="<?= $product->quantity ?>">
                                    <?php if ($product->has_size == 1): ?>
                                        <select data-select data-cart-id="<?= $product->id ?>_<?= $product->size ?>">
                                            <option value="S" <?= $product->size == "S" ? "selected" : "" ?>>S</option>
                                            <option value="M" <?= $product->size == "M" ? "selected" : "" ?>>M</option>
                                            <option value="L" <?= $product->size == "L" ? "selected" : "" ?>>L</option>
                                            <option value="XL" <?= $product->size == "XL" ? "selected" : "" ?>>XL</option>
                                        </select>
                                    <?php endif; ?>
                                </div>
                            </td>

                            <td><?= $product->price ?>&euro;</td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>


            <section id="kosik_add" class="section1">

                <!--<div id="kupon">
                    <h2>Uplatniť kupón</h2>
                    <div>
                        <input type="text" placeholder="Vložte svoj kupón">
                        <button>aplikovať</button>
                    </div>
                </div>-->

                <div id="sucet">
                    <h2 class="kosik_text_sucet">Súčet košíka</h2>
                    <table>
                        <tr>
                            <td class="kosik_text_sucet">Medzisúčet</td>
                            <td><?= $total ?>€</td>
                        </tr>
                        <tr>
                            <td class="kosik_text_sucet">Doprava</td>
                            <td><?= $shipping ?>€</td>
                        </tr>
                        <tr>
                            <td class="kosik_text_sucet"><strong>Celkový súčet</strong></td>
                            <td><strong><?= $total + $shipping ?>€</strong></td>
                        </tr>
                    </table>

                </div>
            </section>

        </div>



    </section>


    <a href="checkout.php"><button class="button_kosik">prejsť k pokladni</button></a>
    <?php require_once "./includes/footer.php" ?>
    <script src="cart.js"></script>
</body>

</html>