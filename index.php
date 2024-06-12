<?php
$bgClass = "bg-index";

include_once("head.php");
include_once("header.php");
include_once("functions.php")
?>
<article class="divBoutique">
    <div class="positionBoutique">
        <?php
        $boutiques = get_all_boutique();
        foreach ($boutiques as $key => $value){
        ?>
            <div class="boutique">
                <a href="confiserie.php?id=<?php echo $value['id']; ?>">
                    <img class="imgBoutique"src="assets/images/<?php echo $key; ?>" alt="<?php echo $value["nom"]; ?>">
                    <h3 class="nomBoutique"><?php echo $value["nom"];?></h3>
                </a>
            </div>

        <?php
        }
        ?>
    </div>
    <div class="posBouton">
        <a class="boutonVoir" href="boutiques.php">Voir plus ></a>
        <div class="remplissage"></div>
    </div>
</article>

<?php
include_once("avis.php");
include_once("apropos.php");
include_once("footer.php");
?>
