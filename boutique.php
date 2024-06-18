<?php
$bgClass = "bg-boutique";
include_once("head.php");
include_once("db.php");
include_once("functions.php");
?>
<div class="loader">
    <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#FF817B" fill-opacity="1" d="M0,96L30,112C60,128,120,160,180,160C240,160,300,128,360,149.3C420,171,480,245,540,266.7C600,288,660,256,720,218.7C780,181,840,139,900,122.7C960,107,1020,117,1080,128C1140,139,1200,149,1260,128C1320,107,1380,53,1410,26.7L1440,0L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"></path></svg>
    <div class="finVague"></div>
</div>

<article class="catalogue-boutique">
    <div class="redirection"><a href="index.php">Accueil</a> > <a href="boutique.php">Boutiques</a> > </div>

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