<nav id="header">
        <a href="/" class="logo">La Flame Wear</a>

        <ul id="bar">
                <li>
                <li><a href="/" class="<?= basename($_SERVER['PHP_SELF']) == "index.php" ? 'active' : '' ?>">domov</a>
                </li>
                <li><a href="vinyl.php"
                                class="<?= basename($_SERVER['PHP_SELF']) == "vinyl.php" ? 'active' : '' ?>">vinyl</a>
                </li>
                <li><a href="cd.php" class="<?= basename($_SERVER['PHP_SELF']) == "cd.php" ? 'active' : '' ?>">CD</a>
                </li>
                <li><a href="tricko.php"
                                class="<?= basename($_SERVER['PHP_SELF']) == "tricko.php" ? 'active' : '' ?>">tričká</a>
                </li>
                <li><a href="mikina.php"
                                class="<?= basename($_SERVER['PHP_SELF']) == "mikina.php" ? 'active' : '' ?>">mikiny</a>
                </li>
                <li><a href="kontakt.php"
                                class="<?= basename($_SERVER['PHP_SELF']) == "kontakt.php" ? 'active' : '' ?>">kontakt</a>
                </li>
                </li>
        </ul>
        <div class="nav-end">

                <a href="kosik.php"
                        class="kosik <?= in_array(basename($_SERVER['PHP_SELF']), ['kosik.php', 'potvrdenie.php', 'checkout.php']) ? 'active' : '' ?>">košík</a>

                <?php if (isset($_SESSION['user'])): ?>

                        <a href="logout.php" class="kosik ">logout</a>
                        <a href="client/" class="kosik ">klient</a>

                <?php else: ?>

                        <a href="login.php"
                                class="kosik <?= in_array(basename($_SERVER['PHP_SELF']), ['login.php']) ? 'active' : '' ?>">login</a>
                <?php endif; ?>
        </div>

</nav>