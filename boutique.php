<?php
$bgClass = "bg-boutique";
include_once("head.php");
include_once("db.php");
include_once("functions.php");
?>


<article class="catalogue-boutique">
    <div class="redirection"><a href="index.php">Accueil</a>><a href="boutique.php">Boutiques</a>></div>

    <div class="txt-catalogue">
        <h2 class="titreCatalogue"><span class="colorConfiserie">Nos boutiques</h2>
        <p>Plongez dans notre joyeuse sélection de bonbons ! Notre liste regorge de saveurs et de textures pour faire pétiller vos papilles. 
            Amateurs de douceurs fruitées ou de friandises acidulées, il y en a pour tous les goûts ! 
        </p>
    </div>

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

</article>
<?php
include_once("avis.php");
include_once("apropos.php");
include_once("footer.php");
?>