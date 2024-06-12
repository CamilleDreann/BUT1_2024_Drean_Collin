<?php
$bgClass = "bg-produitDetaille";
include_once("head.php");
include_once("functions.php");
?>

<article class="produitDetaille">

<div class="redirection"><a href="index.php">Accueil</a>><a href="index.php">Boutiques</a>><a href="index.php">Produits</a></div>



<?php
$infoBonbon =  get_bonbon_info_by_id($_POST['id']);
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
            <div class="blocbtn">
                <button class="petitBouton"><img src="assets/icon/moins.svg" alt="moins"></button>
                <div class="fondpetitBouton"></div>
            </div>
            <div class="blocbtn">
                <button class="petitBouton"><img src="assets/icon/plus.svg" alt="plus"></button>
                <div class="fondpetitBouton"></div>
            </div>
        </div>
        <div class="blocbtn">
            <button class="BtnPanier">
                <h3 class="textBtnPan">Ajouter au panier</h3>
                <img src="assets/icon/ph_basket-bold.svg" alt="panier">
            </button>
            <div class="fondBtnPanier"></div>
        </div>
    </div>
</section>

</article>

<script>

    const BtnPanier = document.querySelector('.BtnPanier');
    const petitBouton = document.querySelector('.petitBouton');


    const petitBoutons = document.querySelectorAll('.petitBouton');

petitBoutons.forEach(button => {
    button.addEventListener('click', function() {
        this.classList.add('clicked');

        setTimeout(() => {
            this.classList.remove('clicked');
        }, 200);
    });
});



    BtnPanier.addEventListener('click', function() {
                // Add the 'clicked' class
                this.classList.add('clicked');

                // Remove the 'clicked' class after the animation duration
                setTimeout(() => {
                    this.classList.remove('clicked');
                }, 200); // Match the duration with the CSS transition duration
            });




</script>


