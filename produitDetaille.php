<?php
$bgClass = "bg-produitDetaille";
include_once("head.php");
include_once("functions.php");
?>

<article class="produitDetaille">
<div class="redirection"> <a href="index.php"> Accueil</a>> <a href="boutique.php"> Boutiques</a>><a href="confiserie.php?>">Produits</a></div>

<?php
$infoBonbon =  get_bonbon_info_by_id($_POST['id']);
$quantite = get_quantite_by_id($_POST['idboutique'],$_POST['id']);
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




        <div class="blocbtn">
            <button class="BtnPanier">
                <h3 class="textBtnPan">Ajouter au panier</h3>
                <img src="assets/icon/ph_basket-bold.svg" alt="panier">
            </button>
            <div class="fondBtnPanier"></div>
        </div>
    </div>
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

    <h2>Autre Produits de la boutique de Candyplaza</h2>

</article>

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
</script>


