<?php
include_once("db.php");
include_once("functions.php");
$bgClass = "bg-boutique";
include_once("head.php");

// Vérifiez si l'utilisateur est connecté et s'il est gérant
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'gerant' || !isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$boutiques = get_boutiques_by_user_id($user_id);
$confiseries = get_all_confiseries(); // fonction à créer pour obtenir toutes les confiseries

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $confiserie_id = $_POST['confiserie_id'];
    $boutique_id = $_POST['boutique_id'];

    if ($action == 'add') {
        $quantite = $_POST['quantite'];
        add_stock($boutique_id, $confiserie_id, $quantite); // fonction à créer pour ajouter du stock
    } elseif ($action == 'delete') {
        delete_stock($boutique_id, $confiserie_id); // fonction à créer pour supprimer du stock
    }

    header("Location: gererStocks.php");
    exit;
}

?>

<article class="article-gererStock">
    <h1 class="title-gererStock">Gérer les Stocks</h1>
    <?php foreach ($boutiques as $boutique): ?>
        <h2>Confiseries dans <?= htmlspecialchars($boutique['nom']) ?></h2>
        <ul>
            <?php
            $confiseries_boutique = get_confiseries_by_boutique_id($boutique['id']);
            foreach ($confiseries_boutique as $confiserie): ?>
                <li><?= htmlspecialchars($confiserie['nom']) ?> - Quantité: <?= htmlspecialchars($confiserie['quantite']) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>

    <h2>Ajouter des Confiseries</h2>
    <form method="post">
        <input type="hidden" name="action" value="add">
        <label for="boutique_id">Boutique :</label>
        <select name="boutique_id" required>
            <?php foreach ($boutiques as $boutique) { ?>
                <option value="<?= $boutique['id'] ?>"><?= $boutique['nom'] ?></option>
            <?php } ?>
        </select>
        <label for="confiserie_id">Confiserie :</label>
        <select name="confiserie_id" required>
            <?php foreach ($confiseries as $confiserie) { ?>
                <option value="<?= $confiserie['id'] ?>"><?= $confiserie['nom'] ?></option>
            <?php } ?>
        </select>
        <label for="quantite">Quantité :</label>
        <input type="number" name="quantite" required>
        <button type="submit">Ajouter</button>
    </form>

    <h2>Supprimer des Confiseries</h2>
    <form method="post">
        <input type="hidden" name="action" value="delete">
        <label for="boutique_id">Boutique :</label>
        <select name="boutique_id" required>
            <?php foreach ($boutiques as $boutique) { ?>
                <option value="<?= $boutique['id'] ?>"><?= $boutique['nom'] ?></option>
            <?php } ?>
        </select>
        <label for="confiserie_id">Confiserie :</label>
        <select name="confiserie_id" required>
            <?php foreach ($confiseries as $confiserie) { ?>
                <option value="<?= $confiserie['id'] ?>"><?= $confiserie['nom'] ?></option>
            <?php } ?>
        </select>
        <button type="submit">Supprimer</button>
    </form>
</article>

<?php
include_once("avis.php");
include_once("apropos.php");
include_once("footer.php");
?>