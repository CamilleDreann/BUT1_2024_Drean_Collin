<?php
include_once("header.php");
include_once("db.php")
?>

<article class="confiserie">
    <div class="redirection"><a href="index.php">Accueil</a>><a href="index.php">Boutiques</a>><a href="index.php">Produits</a></div>
    <?php
    $boutique_id= $_GET['id'];
    $test = requete("SELECT c.id, c.nom, c.type, c.prix, c.illustration, c.description
    FROM confiseries c
    JOIN stocks s ON c.id = s.confiserie_id
    JOIN boutiques b ON s.boutique_id = b.id
    WHERE b.id = $boutique_id ");
    ?>
    <div class="BoutiqueConfiserie">
        <h2 class="titreConfiserie"><span class="colorConfiserie">Les produits de </span> "Candyplaza"</h2>
        <p>Plongez dans notre joyeuse sélection de bonbons ! Notre liste regorge de saveurs et de textures pour faire pétiller vos papilles. 
            Amateurs de douceurs fruitées ou de friandises acidulées, il y en a pour tous les goûts ! 
        </p>
    </div>
    <div class="posConfiserie">
        <?php 
                $colors = ['--main-color', '--rose-primary', '--pink', '--red', '--green'];
                $colorCount = count($colors);
            
                foreach ($test as $key => $value){
                    $colorIndex = $key % $colorCount;
                    $currentColor = $colors[$colorIndex];
        ?>
            <div class="blocConfiserie" style="background-color: var(<?php echo $currentColor; ?>);">
                <img class="sachetbonbon" src="assets/images/bonbons/<?php echo $value['illustration']?>" alt="">
                <h3 class="prixConfiserie"><?php echo $value['prix']?></h3>
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