<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="shortcut icon" type="image/png" href="images/icon.png"/>
    <title>Accueil Confiz</title>
</head>
<body>

<?php
session_start();
?>

<article>
<div class="barNav <?php echo isset($bgClass) ? $bgClass : ''; ?>">
    <ul class="ul-barNav">
        <li class="menu"><a href="#"><img class="menu-barNav" src="./assets/icon/align-justify.svg" alt="menu"></a></li>
        <li class="logo"><a href="index.php"><img class="logo-barNav" src="./assets/icon/logoConfiz.png" alt="logo confiz"></a></li>
        <li class="user-panier">
        <?php if (isset($_SESSION['username'])): ?>
                <a href="logout.php"><img class="user-barNav" src="./assets/icon/log-out.svg" alt="Déconnexion"></a>
            <?php else: ?>
                <a href="connexion.php"><img class="user-barNav" src="./assets/icon/user.svg" alt="icon user"></a>
            <?php endif; ?>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'gerant'): ?>
                    <a href="mesBoutiques.php"><img class="shop-barNav" src="./assets/icon/store.svg" alt="Mes Boutiques"></a>
                <?php endif; ?>

            <a href="#"><img class="panier-barNav" src="./assets/icon/ph_basket-bold.svg" alt="logo panier"></a>
        </li>
    </ul>
</div>

<?php
if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    echo '<div class="admin-badge"><img src="./assets/images/sticker_admin.png" alt="Admin Badge"></div>';
}
elseif(isset($_SESSION['role']) && $_SESSION['role'] == 'gerant') {
    echo '<div class="gerant-badge"><img src="./assets/images/sticker_gerant.png" alt="Gérant Badge"></div>';
}
?>
</article>