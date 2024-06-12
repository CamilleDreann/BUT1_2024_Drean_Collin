<?php
$bgClass = "bg-boutique";
include_once("head.php");
include_once("db.php");
include_once("functions.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'gerant' || !isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user_id']; // Assurez-vous que user_id est bien défini dans la session
$boutiques = get_boutiques_by_user_id($user_id);
?>

<article class="catalogue-boutique">
    <div class="redirection"><a href="index.php">Accueil</a>><a href="boutique.php">Boutiques</a>></div>

    <div class="txt-catalogue">
        <h2 class="titreCatalogue"><span class="colorConfiserie">Mes boutiques</span></h2>
        <p>Plongez dans notre joyeuse sélection de bonbons ! Notre liste regorge de saveurs et de textures pour faire pétiller vos papilles. 
            Amateurs de douceurs fruitées ou de friandises acidulées, il y en a pour tous les goûts ! 
        </p>
    </div>

    <div class="positionBoutique">
        <?php
        foreach ($boutiques as $key => $value) {
        ?>
            <div class="boutique">
                <a href="confiserie.php?id=<?php echo $value['id']; ?>">
                    <img class="imgBoutique" src="assets/images/<?php echo $key; ?>" alt="<?php echo $value["nom"]; ?>">
                    <h3 class="nomBoutique"><?php echo $value["nom"]; ?></h3>
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
