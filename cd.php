<?php
use App\DatabaseController;
require_once "./app/config.php";

$db = new DatabaseController();
$products = $db->openConnection()->prepare("SELECT * FROM products WHERE category = 'cd'");
$products->execute();
$products = $products->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "./includes/head.php" ?>
</head>

<body>

    <?php require_once "./includes/nav.php" ?>

    <section id="cd_bar">
        <div class="nadpis_bar">
            <h2>CD</h2>
        </div>
    </section>

    <section id="hlavny-produkt" class="section1">
        <div class="produkt-kontainer">
            <?php foreach ($products as $product): ?>
                <div class="produkt">
                    <a href="/produkt.php?p=<?= $product->slug ?>"><img src="images/shop/<?= $product->image ?>"
                            alt="<?= $product->name ?>"></a>
                    <div class="popis">
                        <h6><?= $product->name ?></h6>
                        <h5><?= $product->price ?>€</h5>
                    </div>
                </div>
            <?php endforeach; ?>



        </div>
    </section>

    <?php require_once "./includes/footer.php" ?>


</body>



</html>