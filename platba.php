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
        <a href="kosik.html">späť do košíka</a>
        <a href="checkout.html">späť k fakturačnej adrese</a>
        <h2>Pokladňa</h2>
        
    </div>
    <section id="checkout">
        <div id="checkout_faktura">
            <h3>Platba</h3>
            <br><label for="meno-karta">Zadajte meno držiteľa karty</label></br>
            <input type="text" placeholder="meno držiteľa karty">

            <br><label for="cislo-karta">Zadajte číslo karty</label></br>
            <input type="text" placeholder="číslo karty">

            <br><label for="platnost-karta">Zadajte platnosť karty</label></br>
            <input type="text" placeholder="platnosť karty (MM/RR)">

            <br><label for="cvv-karta">Zadajte bezpečnostný kód</label></br>
            <input type="text" placeholder="bezpečnostný kód">

        </div>

    </section>

    <a href="potvrdenie.html"><button class="button_platba">potvrdiť a objednať</button></a>


    <?php require_once "./includes/footer.php" ?>
</body>
</html>