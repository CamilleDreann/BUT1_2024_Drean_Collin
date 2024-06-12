<?php

$bgClass = "bg-confiserie";
include_once("head.php");
include_once("functions.php");


$nom = get_nom_boutique_by_id($_GET["id"]);
?>

<article class="confiserie">
    <div class="redirection"><a href="index.php">Accueil</a>><a href="boutique.php">Boutiques</a>><a href="confiserie.php">Produits</a></div>

    <div class="BoutiqueConfiserie">
        <h2 class="titreConfiserie"><span class="colorConfiserie">Les produits de </span> <?php echo $nom;?></h2>
        <p>Plongez dans notre joyeuse sélection de bonbons ! Notre liste regorge de saveurs et de textures pour faire pétiller vos papilles. 
            Amateurs de douceurs fruitées ou de friandises acidulées, il y en a pour tous les goûts ! 
        </p>
    </div>
    <div class="posConfiserie">
        <?php 
                $colors = ['--main-color', '--rose-primary', '--pink', '--red', '--green'];
                $colorCount = count($colors);
                $infoConfiserie = get_confiserie_info_by_boutique_id($_GET["id"]);
                    foreach ($infoConfiserie as $key => $value){
                    $colorIndex = $key % $colorCount;
                    $currentColor = $colors[$colorIndex];
        ?>
            <div class="blocConfiserie" style="background-color: var(<?php echo $currentColor; ?>);">
            <form action="produitDetaille.php" method="post">
                <input type="hidden" name="id" value="<?php echo $value['id']; ?>">
                <input type="hidden" name="color" value="<?php echo $currentColor; ?>">
                <input type="hidden" name="boutique" value="<?php echo $nom; ?>">
                <button type="submit" class="btnConfiserie">
                    <img class="sachetbonbon" src="assets/images/bonbons/<?php echo $value['illustration']; ?>" alt="">
                    <h3 class="prixConfiserie"><?php echo $value['prix']; ?> €</h3>
                    <h3 class="nomBonbon"><?php echo $value['nom']; ?></h3>
                    <button class="panierConfiserie"><img src="assets/icon/ph_basket-bold.svg" alt="panier"></button>
                </button>
            </form>
            </div>


        <?php 
            }
        ?>
    </div>
</article>
<script> 

let blocConfiserie = document.querySelectorAll(".blocConfiserie");

blocConfiserie.forEach(element => {
    let imagesachet = element.querySelector(".sachetbonbon");
    let nomBonbon = element.querySelector(".nomBonbon");

    element.addEventListener("mouseleave", function(event) {
            nomBonbon.style.opacity = "0";
            imagesachet.style.transform = "translateY(0)";
            nomBonbon.style.transform = " translateY(-200px)";
        });
        element.addEventListener("mouseenter", function(event) {
            imagesachet.style.transform = "rotate(-20deg) translateY(-110px)";
            imagesachet.style.transition = "transform 0.2s ease-in-out";
            nomBonbon.style.transform = " translateY(-160px) translateX(80px) rotate(-20deg)";
            nomBonbon.style.transition = "opacity 0.18s ease-in-out, transform 0.4s ease-in-out";
            nomBonbon.style.opacity = "1";
        });

});

</script>
<?php
include_once("avis.php");
include_once("apropos.php");
include_once("footer.php");
?>