<?php
include_once("db.php");
$bgClass = "bg-boutique";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once("head.php");

if (!isset($_SESSION['role']) || !isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

if ($role == 'admin') {
    $boutiques = get_all_boutique();
} elseif ($role == 'gerant') {
    $boutiques = get_boutiques_by_user_id($user_id);
}
$confiseries = get_all_confiseries();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
   

    if ($role == 'admin') {
        if ($action == 'add_boutique') {
            $nom = $_POST['nom'];
            $utilisateur_id = $_POST['utilisateur_id'];
            $numero_rue = $_POST['numero_rue'];
            $nom_adresse = $_POST['nom_adresse'];
            $code_postal = $_POST['code_postal'];
            $ville = $_POST['ville'];
            $pays = $_POST['pays'];
            add_boutique($nom, $utilisateur_id, $numero_rue, $nom_adresse, $code_postal, $ville, $pays);
            $_SESSION["ajout-boutique"] = "Boutique ajoutée avec succès.";
        } elseif ($action == 'delete_boutique') {
            $boutique_id = $_POST['boutique_id'];
            delete_boutique($boutique_id);
            $_SESSION["ajout-boutique"] = "Boutique supprimée avec succès.";
        } elseif ($action == 'add_confiserie') {
            $nom = $_POST['nom'];
            $type = $_POST['type'];
            $prix = $_POST['prix'];
            $illustration = $_POST['illustration'];
            $description = $_POST['description'];
            add_confiserie($nom, $type, $prix, $illustration, $description);
            $_SESSION["ajout-confiserie"] = "Confiserie ajoutée avec succès.";
        } elseif ($action == 'update_confiserie') {
            $id = $_POST['id'];
            $nom = $_POST['nom'];
            $type = $_POST['type'];
            $prix = $_POST['prix'];
            $illustration = $_POST['illustration'];
            $description = $_POST['description'];
            update_confiserie($id, $nom, $type, $prix, $illustration, $description);
            $_SESSION["ajout-confiserie"] = "Confiserie mise à jour avec succès.";
        } elseif ($action == 'delete_confiserie') {
            $confiserie_id = $_POST['confiserie_id'];
            delete_confiserie($confiserie_id);
            $_SESSION["ajout-confiserie"] = "Confiserie supprimée avec succès.";
        }
        
    } elseif ($role == 'gerant' && ($action == 'add' || $action == 'delete')) {
        $confiserie_id = $_POST['confiserie_id'];
        $boutique_id = $_POST['boutique_id'];
            if ($action == 'add') {
                $quantite = $_POST['quantite'];
                add_stock($boutique_id, $confiserie_id, $quantite);
                $_SESSION["ajout-bonbon"] = "Bonbon ajouté avec succès.";
            } elseif ($action == 'delete') {
                delete_stock($boutique_id, $confiserie_id);
                $_SESSION["ajout-bonbon"] = "Bonbon supprimé avec succès.";
            }
    }

    
   
}


?>



<article class="article-gererStock">

<h2 class="title-gererStock">Gérer les Stocks</h2>

<?php
if (isset($_SESSION["ajout-bonbon"])) {
    echo '<p class="ajout-bonbon">' . $_SESSION["ajout-bonbon"] . '</p>';
    unset($_SESSION["ajout-bonbon"]);
}
if (isset($_SESSION["ajout-boutique"])) {
    echo '<p class="ajout-bonbon">' . $_SESSION["ajout-boutique"] . '</p>';
    unset($_SESSION["ajout-boutique"]);
}
if (isset($_SESSION["ajout-confiserie"])) {
    echo '<p class="ajout-bonbon">' . $_SESSION["ajout-confiserie"] . '</p>';
    unset($_SESSION["ajout-confiserie"]);
}
?>



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
    <a href="confiserie.php?id=<?= $boutique['id'] ?>" class="bouton-gestion">Voir la boutique</a> 
<?php endforeach; ?>
</div>



<?php if ($role == 'gerant'): ?>
    <div class="div-ajouterBonbon">
        <h3 class="title-article-gererStock">Ajouter des Confiseries</h3>
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
            <button class="bouton-gestion" type="submit">Ajouter</button>
        </form>
    </div>

    <div class="div-supprimerBonbon">
        <h3 class="title-article-gererStock">Supprimer des Confiseries</h3>
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
            <button class="bouton-gestion" type="submit">Supprimer</button>
        </form>
    </div>
<?php endif; ?>

<?php if ($role == 'admin'): ?>
    <div class="div-ajouterBonbon">
    <h3 class="title-article-gererStock">Ajouter une Boutique</h3>
    <form method="post">
        <input type="hidden" name="action" value="add_boutique">

        <div class="div-boutiqueAdd">
        <label class="label-boutique" for="nom">Nom de la Boutique :</label>
        <input class="select-boutique" type="text" name="nom" required>
        </div>

        <div class="div-boutiqueAdd">
        <label class="label-boutique" for="utilisateur_id">ID de l'Utilisateur :</label>
        <select class="select-boutique" name="utilisateur_id" required>
            <?php
            $users = get_all_users();
            foreach ($users as $user) { ?>
                <option value="<?= $user['id'] ?>"><?= $user['username'] ?> (<?= $user['role'] ?>)</option>
            <?php } ?>
        </select>
        </div>

        <div class="div-boutiqueAdd">
        <label class="label-boutique" for="numero_rue">Numéro de Rue :</label>
        <input class="select-boutique" type="text" name="numero_rue" required>
        </div>

        <div class="div-boutiqueAdd">
        <label class="label-boutique" for="nom_adresse">Nom de l'Adresse :</label>
        <input class="select-boutique" type="text" name="nom_adresse" required>
        </div>

        <div class="div-boutiqueAdd">
        <label class="label-boutique" for="code_postal">Code Postal :</label>
        <input class="select-boutique" type="text" name="code_postal" required>
        </div>

        <div class="div-boutiqueAdd">
        <label class="label-boutique" for="ville">Ville :</label>
        <input class="select-boutique" type="text" name="ville" required>
        </div>

        <div class="div-boutiqueAdd">
        <label class="label-boutique" for="pays">Pays :</label>
        <input class="select-boutique" type="text" name="pays" required>
        </div>

        
        <button class="bouton-gestion" type="submit">Ajouter</button>
        
    </form>
    </div>

    <div class="div-ajouterBonbon">
    <h3 class="title-article-gererStock">Supprimer une Boutique</h3>
    <form method="post">
        <input type="hidden" name="action" value="delete_boutique">

        <div class="div-boutiqueAdd">
        <label class="label-boutique" for="boutique_id">Boutique :</label>
        <select class="select-boutique" name="boutique_id" required>
            <?php foreach ($boutiques as $boutique) { ?>
                <option value="<?= $boutique['id'] ?>"><?= $boutique['nom'] ?></option>
            <?php } ?>
        </select>
        </div>

        .
        <button class="bouton-gestion" type="submit">Supprimer</button>
        .
    </form>
    </div>
    
    <div class="div-ajouterBonbon">
        <h3 class="title-article-gererStock">Ajouter une Confiserie</h3>
        <form method="post">
            <input type="hidden" name="action" value="add_confiserie">
            <div>
                <label class="label-boutique" for="nom">Nom :</label>
                <input class="select-boutique" type="text" name="nom" required>
            </div>
            <div>
                <label class="label-boutique" for="type">Type :</label>
                <input class="select-boutique" type="text" name="type" required>
            </div>
            <div>
                <label class="label-boutique" for="prix">Prix :</label>
                <input class="select-boutique" type="number" step="0.01" name="prix" required>
            </div>
            <div>
                <label class="label-boutique" for="illustration">URL de l'illustration :</label>
                <input class="select-boutique" type="text" name="illustration" required>
            </div>
            <div>
                <label class="label-boutique" for="description">Description :</label>
                <textarea class="select-boutique" name="description" required></textarea>
            </div>
            
            .
        <button class="bouton-gestion" type="submit">Ajouter</button>
        .

        </form>
    </div>

    <div class="div-ajouterBonbon">
        <h3 class="title-article-gererStock">Mettre à jour une Confiserie</h3>
        <form method="post">
            <input type="hidden" name="action" value="update_confiserie">
            <div>
                <label class="label-boutique" for="id">Confiserie :</label>
                <select class="select-boutique" name="id" required>
                    <?php foreach ($confiseries as $confiserie) { ?>
                        <option value="<?= $confiserie['id'] ?>"><?= $confiserie['nom'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <label class="label-boutique" for="nom">Nom :</label>
                <input class="select-boutique"  type="text" name="nom" required>
            </div>
            <div>
                <label class="label-boutique" for="type">Type :</label>
                <input class="select-boutique"  type="text" name="type" required>
            </div>
            <div>
                <label class="label-boutique" for="prix">Prix :</label>
                <input class="select-boutique"  type="number" step="0.01" name="prix" required>
            </div>
            <div>
                <label class="label-boutique" for="illustration">URL de l'illustration :</label>
                <input class="select-boutique" type="text" name="illustration" required>
            </div>
            <div>
                <label class="label-boutique" for="description">Description :</label>
                <textarea class="select-boutique" name="description" required></textarea>
            </div>
            
            .
        <button class="bouton-gestion" type="submit">Mettre à jour</button>
        .
        </form>
    </div>

    <div class="div-ajouterBonbon">
        <h3 class="title-article-gererStock">Supprimer une Confiserie</h3>
        <form method="post">
            <input class="select-boutique" type="hidden" name="action" value="delete_confiserie">
            <div>
                <label class="label-boutique" for="confiserie_id">Confiserie :</label>
                <select class="select-boutique" name="confiserie_id" required>
                    <?php foreach ($confiseries as $confiserie) { ?>
                        <option value="<?= $confiserie['id'] ?>"><?= $confiserie['nom'] ?></option>
                    <?php } ?>
                </select>
            </div>
            .
        <button class="bouton-gestion" type="submit">Supprimer</button>
        .
        </form>
    </div>

<?php endif; ?>

</article>
