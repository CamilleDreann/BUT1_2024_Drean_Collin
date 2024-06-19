<?php
$bgClass = "bg-panier";
include_once("head.php");
include_once("functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['insertPanier'])) {
        add_panier($_SESSION["user_id"],$_POST["id"],$_POST["quantiteProduit"]);
    }
    header('Location: panier.php');
    exit();
}


?>
<main class="fondpanier">
    <article class="panier">
        <?php 
                        $confiserie = afficher_Panier($_SESSION["user_id"]);
                        $totalPrix = 0;
                        foreach ($confiserie as $key => $value){
        ?>
        <div class="bonbonPanier">
                <img class="sachetbonbon" src="assets/images/bonbons/<?php echo $value['illustration']; ?>" alt="<?php echo $value['nom_confiserie']; ?>">
                <div class="infoBonbonPanier">
                    <h2><?php echo $value["nom_confiserie"]?></h3>
                    <p><?php echo $value["description"]?></p>
                </div>
                <div class="blocPrix">
                    <p><?php echo $value["quantite"]?> sachets</p>
                    <h3 class="prixQuantite"><?php echo $value["quantite"]*$value["prix"]; ?>€</h3>
                </div>
        </div>
        <hr>
        

    <?php 
    $totalPrix = $totalPrix + $value["quantite"]*$value["prix"];
} ?>


        <h3 class="prixTotal">Prix du panier : <?php echo $totalPrix?>€</h3>
    </article>
</main>