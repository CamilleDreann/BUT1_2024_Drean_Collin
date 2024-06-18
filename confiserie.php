<?php

$bgClass = "bg-confiserie";
include_once("head.php");
include_once("functions.php");


$nom = get_nom_boutique_by_id($_GET["id"]);
?>
<div class="loader">
    <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#FF817B" fill-opacity="1" d="M0,96L30,112C60,128,120,160,180,160C240,160,300,128,360,149.3C420,171,480,245,540,266.7C600,288,660,256,720,218.7C780,181,840,139,900,122.7C960,107,1020,117,1080,128C1140,139,1200,149,1260,128C1320,107,1380,53,1410,26.7L1440,0L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"></path></svg>
    <div class="finVague"></div>
</div>

<article class="confiserie">
    <div class="redirection"><a href="index.php">Accueil</a> > <a href="boutique.php">Boutiques</a> > <a href="confiserie.php?id=<?php echo $_GET["id"]?>">Produits</a></div>

    <div class="BoutiqueConfiserie">
        <h2 class="titreConfiserie"><span class="colorConfiserie">Les produits de </span> <?php echo $nom[0]["nom"];;?></h2>
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
                    if ($value["quantite"]==0){?>
                        <div class="blocConfiserie grey" style="background-color: var(<?php echo $currentColor; ?>);">
                            <img class="sachetbonbon" src="assets/images/bonbons/<?php echo $value['illustration']; ?>" alt="">
                            <h3 class="prixConfiserie"><?php echo $value['prix']; ?> €</h3>
                            <h3 class="nomBonbon"><?php echo $value['nom']; ?></h3>
                        </div>
                        <?php
                    }
                    else {

              ?>      
            <div class="blocConfiserie" style="background-color: var(<?php echo $currentColor; ?>);">
            <form action="produitDetaille.php" method="post">
                <input type="hidden" name="id" value="<?php echo $value['id']; ?>">
                <input type="hidden" name="color" value="<?php echo $currentColor; ?>">
                <input type="hidden" name="boutique" value="<?php echo $nom[0]["nom"]; ?>">
                <input type="hidden" name="idboutique" value="<?php echo $nom[0]["id"]; ?>">
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