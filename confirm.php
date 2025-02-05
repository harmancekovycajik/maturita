<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['order_complete']) || empty($_SESSION['order_complete'])) {
    header("Location: /");
}
unset($_SESSION['order_complete']);

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
        <h2>Pokladňa</h2>
    </div>
    <section id="checkout_pot">
        <div id="checkout_potvrdenie">
            <h3>Potvrdenie</h3>
            <h2>ĎAKUJEME ZA OBJEDNÁVKU!</h2>
            <h3>Vaša platba prebehla úspešne!</h3>

        </div>

    </section>

<!--<a href="/"><button class="button_platba">vrátiť sa späť na domovskú obrazovku</button></a>-->


    <?php require_once "./includes/footer.php" ?>
</body>

</html>