<?php
$bgClass = "bg-produitDetaille";
include_once("head.php");
include_once("functions.php");
?>
<div class="loader">
    <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#FF817B" fill-opacity="1" d="M0,96L30,112C60,128,120,160,180,160C240,160,300,128,360,149.3C420,171,480,245,540,266.7C600,288,660,256,720,218.7C780,181,840,139,900,122.7C960,107,1020,117,1080,128C1140,139,1200,149,1260,128C1320,107,1380,53,1410,26.7L1440,0L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"></path></svg>
    <div class="finVague"></div>
</div>
<article class="produitDetaille">
<div class="redirection"><a href="index.php">Accueil</a> > <a href="boutique.php">Boutiques</a> > <a href="confiserie.php">Produits</a></div>

<?php
$infoBonbon =  get_bonbon_info_by_id($_POST['id']);
$quantite = get_quantite_by_id($_POST['idboutique'],$_POST['id']);
$nom = get_nom_boutique_by_id($_POST['idboutique']);
$illustration = is_url($value['illustration']) ? $value['illustration'] : "assets/images/bonbons/" . $value['illustration'];



?>
<section class="posBonbon">
    <div class="fondBonbon" style="background-color: var(<?php echo $_POST['color']; ?>);">
        <img src="assets/images/bonbons/<?php echo $infoBonbon[0]["illustration"];?>" alt="<?php echo $infoBonbon[0]["nom"];?>">
    </div>
    <div class="infoBonbon">
        <h3 class="bonbonBoutique" ><?php echo $_POST["boutique"]?></h2>
        <h2 class="titreBonbon" style="-webkit-text-stroke: var(<?php echo $_POST["color"].')'?>1px;"><?php echo $infoBonbon[0]["nom"]?></h2>
        <h3 class="detailBonbon"><?php echo $infoBonbon[0]["type"]?></h4>
        <h3 class="detailBonbon">Prix unitaire : <span><?php echo $infoBonbon[0]["prix"] ?>€</span></h3>






        <div class="posPlusMoins">
            <div class="blocbtn1">
                <button class="petitBouton moins"><img src="assets/icon/moins.svg" alt="moins"></button>
                <div class="fondpetitBouton"></div>
            </div>
            <h3 class="detailBonbon compteur">0</h3>
            <div class="blocbtn1">
                <button class="petitBouton plus"><img src="assets/icon/plus.svg" alt="plus"></button>
                <div class="fondpetitBouton"></div>
            </div>
        </div>
        <h3 class="quantite"><?php $feur = get_quantite_by_id($_POST['idboutique'],$_POST['id']);
        echo $feur[0]["quantite"];
        ?></h3>

<?php $user_id = isset($_SESSION['user_id']);


    if (empty($user_id)) {
        echo '<div class="erreur"> Connectez-vous pour ajouter au panier. </div>';
    }
    else {
        ?>



        <form method="post" action="panier.php" id="panierForm">
            <input type="hidden" name="quantiteProduit" id="quantiteProduit">
            <input type="hidden" name="idboutique" value="<?php echo $_POST['idboutique']; ?>">
            <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
            <input type="hidden" name="insertPanier" value="add">
            <div class="blocbtn">
                <button type="button" class="BtnPanier" name="insertPanier">
                    <h3 class="textBtnPan">Ajouter au panier</h3>
                    <img src="assets/icon/ph_basket-bold.svg" alt="panier">
                </button>
                <div class="fondBtnPanier"></div>
            </div>
        </form>
        <?php  }?>
</section>



    <div class="slider">
        <div class="slide-track">
            <h3 class="slide">Sans Arome artificiel</h3>
            <h3 class="slide">Tros Bon</h3>
            <h3 class="slide">Sans Edulcorant</h3>
            <h3 class="slide">Origine France</h3>
            <h3 class="slide">Sans Arome artificiel</h3>
            <h3 class="slide">Tros Bon</h3>
            <h3 class="slide">Sans Edulcorant</h3>
            <h3 class="slide">Origine France</h3>
            <h3 class="slide">Sans Arome artificiel</h3>
            <h3 class="slide">Tros Bon</h3>
            <h3 class="slide">Sans Edulcorant</h3>
            <h3 class="slide">Origine France</h3>
            <h3 class="slide">Sans Arome artificiel</h3>
            <h3 class="slide">Tros Bon</h3>
            <h3 class="slide">Sans Edulcorant</h3>
            <h3 class="slide">Origine France</h3>
        </div>
    </div>
    <div class="autreBonbon">
            <h2>Autre Produits de la boutique de Candyplaza</h2>

            <div class="slideBonbon">
                <div class="divBonbon">
                    <?php 
                        $colors = ['--main-color', '--rose-primary', '--pink', '--red', '--green'];
                        $colorCount = count($colors);
                        $infoConfiserie = get_confiserie_info_by_boutique_id($_POST['idboutique']);
                        $totalItems = 0;

                        while ($totalItems < 17) {
                            foreach ($infoConfiserie as $key => $value){
                                if ($totalItems >= 17) break; 
                                
                                $colorIndex = $totalItems % $colorCount;
                                $currentColor = $colors[$colorIndex];
                                ?>
                                <form action="produitDetaille.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $value['id']; ?>">
                                    <input type="hidden" name="color" value="<?php echo $currentColor; ?>">
                                    <input type="hidden" name="boutique" value="<?php echo $nom[0]["nom"]; ?>">
                                    <input type="hidden" name="idboutique" value="<?php echo $nom[0]["id"]; ?>">
                                    <button type="submit" class="btnConfiserie">
                                        <div class="bonbon" style="background-color: var(<?php echo $currentColor; ?>);">
                                            <img class="sachetbonbon" src="assets/images/bonbons/<?php echo $value['illustration']; ?>" alt="<?php echo $value['nom']; ?>">
                                        </div>
                                    </button>
                                </form>
                                <?php
                                $totalItems++;
                            }
                        }
                    ?>
                </div>
            </div>
    </div>
</article>
<?php 
include_once("footer.php");

?>

<script>

    const BtnPanier = document.querySelector('.BtnPanier');
    const petitBoutons = document.querySelectorAll('.petitBouton');
    const plus = document.querySelector('.plus');
    const moins = document.querySelector('.moins');

        petitBoutons.forEach(button => {
            button.addEventListener('click', function() {
                this.classList.add('clicked');

                setTimeout(() => {
                    this.classList.remove('clicked');
                }, 200);
            });
        });
    BtnPanier.addEventListener('click', function() {
                this.classList.add('clicked');

                setTimeout(() => {
                    this.classList.remove('clicked');
                }, 200);
            });



            function updateQuantity(amount) {

                const compteur = document.querySelector('.compteur');
                let currentQuantity = parseInt(compteur.textContent);

                const quantite = document.querySelector('.quantite');
                let max = parseInt(quantite.textContent);

                currentQuantity += amount;
                if (currentQuantity < 0) {
                    currentQuantity = 0;
                }
                else if (currentQuantity > max) {
                    currentQuantity = max;
                }
                compteur.textContent = currentQuantity;
                }




                
document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('.plus').addEventListener('click', () => {
        updateQuantity(1);
    });
    document.querySelector('.moins').addEventListener('click', () => {
        updateQuantity(-1);
    });
})
document.querySelector('.BtnPanier').addEventListener('click', () => {
                const compteur = document.querySelector('.compteur');
                const quantiteProduitInput = document.getElementById('quantiteProduit');
                quantiteProduitInput.value = compteur.textContent;
                document.getElementById('panierForm').submit();
            });
</script>


