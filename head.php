<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="shortcut icon" type="image/png" href="images/icon.png" />
    <title>Accueil Confiz</title>
</head>

<body>

    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include_once ("functions.php");
    ?>


    <article>
        <div class="barNav <?php echo isset($bgClass) ? $bgClass : ''; ?>">
            <ul class="ul-barNav">
                <li class="menu"><button class="menu" type="button"><img class="menu-barNav"
                            src="./assets/icon/align-justify.svg" alt="menu"></button></li>
                <!-- <li class="logo"><a href="index.php"><img class="logo-barNav" src="./assets/icon/logoConfiz.png"
                            alt="logo confiz"></a></li> -->
                <li class="user-panier">

                    <?php if (isset($_SESSION['username'])): ?>
                        <a href="logout.php"><img class="user-barNav" src="./assets/icon/log-out.svg" alt="Déconnexion"></a>
                    <?php else: ?>
                        <a href="connexion.php"><img class="user-barNav" src="./assets/icon/user.svg" alt="icon user"></a>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'gerant')): ?>
                        <a href="gererStocks.php"><img class="shop-barNav" src="./assets/icon/store.svg"
                                alt="Gérer Stock ou boutique selon le rôle"></a>
                    <?php endif; ?>

                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                <a href="gestionUtilisateurs.php"><img class="user-barNav" src="./assets/icon/user-cog.svg" alt="Gérer les utilisateurs"></a>
            <?php endif; ?>
            <?php


            if (isset($_SESSION['user_id'])) {
        ?>
            <a href="panier.php"><img class="panier-barNav" src="./assets/icon/ph_basket-bold.svg" alt="logo panier"></a>
            <?php
            }
            ?>
        </li>
    </ul>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                        <a href="gestionUtilisateurs.php"><img class="user-barNav" src="./assets/icon/user-cog.svg"
                                alt="Gérer les utilisateurs"></a>
                    <?php endif; ?>

                    <a href="panier.php"><img class="panier-barNav" src="./assets/icon/ph_basket-bold.svg"
                            alt="logo panier"></a>
                </li>
            </ul>


            <div class="menuBoutique">
                <?php
                $boutiques = get_all_boutique();
                foreach ($boutiques as $key => $value) {
                    ?>
                    <div class="boutique">
                        <a href="confiserie.php?id=<?php echo $value['id']; ?>">
                            <img class="imgBoutique" src="assets/images/<?php echo $key; ?>"
                                alt="<?php echo $value["nom"]; ?>">
                            <h3 class="nomBoutique"><?php echo $value["nom"]; ?></h3>
                        </a>
                    </div>

                    <?php
                }
                ?>
            </div>

            <div class="logo-head">
                <a href="index.php"><img class="logo-barNav" src="./assets/icon/logoConfiz.png" alt="logo confiz"></a>
            </div>
        </div>




        <script>
            var boutonMenu = document.querySelector(".menu");
            var barnav = document.querySelector(".ul-barNav");
            var menuBoutique = document.querySelector(".menuBoutique");
            var body = document.querySelector("body");
            var menubarNav = document.querySelector(".menu-barNav");




            boutonMenu.addEventListener("click", (event) => {
                boutonMenu.classList.toggle('active');
                if (boutonMenu.classList.contains('active')) {
                    menuBoutique.style.display = 'flex';
                    body.style.animation = 'none'
                    body.style.overflow = 'hidden';
                    menubarNav.src = 'assets/icon/croix.svg';
                } else {
                    menuBoutique.style.display = 'none';
                    barnav.style.display = 'flex';
                    body.style.overflow = '';
                    menubarNav.src = 'assets/icon/align-justify.svg';
                }
            });
        </script>

        <?php
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
            echo '<div class="admin-badge"><img src="./assets/images/sticker_admin.png" alt="Admin Badge"></div>';
        } elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'gerant') {
            echo '<div class="gerant-badge"><img src="./assets/images/sticker_gerant.png" alt="Gérant Badge"></div>';
        }
        ?>
    </article>