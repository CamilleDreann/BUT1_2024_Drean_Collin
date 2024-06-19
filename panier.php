<?php
$bgClass = "bg-panier";
include_once("head.php");
include_once("functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['insertPanier'])) {
        add_panier($_SESSION["user_id"],$_POST["id"],$_POST["quantiteProduit"],$_POST["idboutique"]);
        retrait_stock($_POST["quantiteProduit"],$_POST["idboutique"],$_POST["id"]);
    }
    elseif (isset($_POST['viderPanier'])) {
        print_r($_POST);
        retour_stock($_POST["id"],$_POST["idboutique"]);
        vider_panier($_SESSION["user_id"], $_POST["idpanier"]);
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
                    <form action="panier.php" method="post">
                    <input type="hidden" name="viderPanier">
                    <input type="hidden"name="idboutique" value="<?php echo  $value["boutique_id"];?>">
                    <input type="hidden"name="id" value="<?php echo  $value["confiserie_id"];?>">
                    <input type="hidden"name="idpanier" value="<?php echo  $value["id"];?>">
                    <div class="posBouton">
                        <button class="boutonVoir" type="submit">Supprimer Article</button>
                        <div class="remplissage"></div>
                    </div>
                </form>
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


<?php 
include_once("footer.php");?>