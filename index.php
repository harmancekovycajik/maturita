<?php
use App\DatabaseController;

require_once "./app/config.php";


$db = new DatabaseController();

$selection = $db->openConnection()->prepare("SELECT * FROM product_selection INNER JOIN products ON products.id = product_selection.product_id");
$selection->execute();
$selection = $selection->fetchAll();

$recommended = array_filter($selection, function ($obj) {
  return $obj->type === 'recommended';
});

$news = array_filter($selection, function ($obj) {
  return $obj->type === 'news';
});


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
      <h2>vitajte na Travis Scott Fan-Shope</h2>
      <p>nájdete tu vinylové platne, CD-čka a oblečenie</p>
    </div>
  </section>

  <section id="hlavny-produkt" class="section1">
    <h4 class="home-nadpis">NOVINKY</h4>
    <div id="news" class="swiper produkt-kontainer">
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-wrapper">
        <?php foreach ($news as $row): ?>
          <div class="produkt swiper-slide">
            <a href="produkt.php?p=<?= $row->slug ?>"><img src="images/shop/<?= $row->image ?>"
                alt="<?= $row->name ?>" /></a>
            <div class="popis">
              <h6><?= $row->name ?></h6>
              <h5><?= $row->price ?>&euro;</h5>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <h4 class="home-nadpis">ODPORÚČANÉ PRODUKTY</h4>
    <div id="recommended" class="produkt-kontainer swiper">
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-wrapper">
        <?php foreach ($recommended as $row): ?>
          <div class="produkt swiper-slide">
            <a href="produkt.php?p=<?= $row->slug ?>"><img src="images/shop/<?= $row->image ?>"
                alt="<?= $row->name ?>" /></a>
            <div class="popis">
              <h6><?= $row->name ?></h6>
              <h5><?= $row->price ?>&euro;</h5>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php require_once "./includes/footer.php" ?>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    const news = new Swiper("#news", {
      // Optional parameters
      direction: "horizontal",
      loop: true,
      slidesPerView: 4,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
    const recommended = new Swiper("#recommended", {
      // Optional parameters
      direction: "horizontal",
      loop: true,
      slidesPerView: 4,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  </script>
</body>

</html>