<?php
include_once("db.php");
include_once("functions.php");
$bgClass = "bg-boutique";
include_once("head.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'gerant' || !isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$boutiques = get_boutiques_by_user_id($user_id);
$confiseries = get_all_confiseries(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $confiserie_id = $_POST['confiserie_id'];
    $boutique_id = $_POST['boutique_id'];

    if ($action == 'add') {
        $quantite = $_POST['quantite'];
        error_log("Ajout de $quantite de la confiserie $confiserie_id dans la boutique $boutique_id");
        add_stock($boutique_id, $confiserie_id, $quantite); 
        error_log("Stock ajouté avec succès");
        $_SESSION["ajout-bonbon"] = "Bonbon ajouté avec succès.";

    } elseif ($action == 'delete') {
        delete_stock($boutique_id, $confiserie_id); 
        $_SESSION["ajout-bonbon"] = "Bonbon supprimé avec succès.";
    }

    header("Location: gererStocks.php");
    exit;
}

?>

<article class="article-gererStock">

<?php
if (isset($_SESSION["ajout-bonbon"])) {
    echo '<p class="ajout-bonbon">' . $_SESSION["ajout-bonbon"] . '</p>';
    unset($_SESSION["ajout-bonbon"]);
}
?>

    <h2 class="title-gererStock">Gerer les Stocks</h2>

    <div class="div-liste-stock">
    <?php foreach ($boutiques as $boutique): ?>
        <h3 class="title-article-gererStock">Confiseries dans <?= htmlspecialchars($boutique['nom']) ?></h3>
        <ul>
            <?php
            $confiseries_boutique = get_confiseries_by_boutique_id($boutique['id']);
            foreach ($confiseries_boutique as $confiserie): ?>
                <li><?= htmlspecialchars($confiserie['nom']) ?> - Quantité: <?= htmlspecialchars($confiserie['quantite']) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>
    </div>

    <div class="div-ajouterBonbon">
    <h3 class="title-article-gererStock" >Ajouter des Confiseries</h3>
    <form method="post">
        <input type="hidden" name="action" value="add">

        <div class="div-boutiqueAdd">
        <label class="label-boutique" for="boutique_id">Boutique :</label>
        <select class="select-boutique" name="boutique_id" required>
            <?php foreach ($boutiques as $boutique) { ?>
                <option value="<?= $boutique['id'] ?>"><?= $boutique['nom'] ?></option>
            <?php } ?>
        </select>
        </div>

        <div class="div-confiserieAdd">
        <label class="label-boutique" for="confiserie_id">Confiserie :</label>
        <select class="select-boutique" name="confiserie_id" required>
            <?php foreach ($confiseries as $confiserie) { ?>
                <option value="<?= $confiserie['id'] ?>"><?= $confiserie['nom'] ?></option>
            <?php } ?>
        </select>
        </div>

        <div class="div-quantiteAdd">
        <label class="label-boutique" for="quantite">Quantité :</label>
        <input class="select-boutique" type="number" name="quantite" required>
        </div>

        <div class="posBouton">
        <button class="boutonVoir" type="submit">Ajouter</button>
        <div class="remplissage"></div>
    </form>
    </div>

    <div class="div-supprimerBonbon">
    <h3 class="title-article-gererStock" >Supprimer des Confiseries</h3>
    <form method="post">
        <input type="hidden" name="action" value="delete">

        <div class="div-boutiqueAdd">
        <label class="label-boutique" for="boutique_id">Boutique :</label>
        <select class="select-boutique" name="boutique_id" required>
            <?php foreach ($boutiques as $boutique) { ?>
                <option value="<?= $boutique['id'] ?>"><?= $boutique['nom'] ?></option>
            <?php } ?>
        </select>
        </div>

        <div class="div-confiserieAdd">
        <label class="label-boutique" for="confiserie_id">Confiserie :</label>
        <select class="select-boutique" name="confiserie_id" required>
            <?php foreach ($confiseries as $confiserie) { ?>
                <option value="<?= $confiserie['id'] ?>"><?= $confiserie['nom'] ?></option>
            <?php } ?>
        </select>
        </div>

        <div class="posBouton">
        <button class="boutonVoir" type="submit">Supprimer</button>
        <div class="remplissage"></div>
    </form>
    </div>
</article>
