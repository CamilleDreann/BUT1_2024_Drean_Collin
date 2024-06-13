<?php
include_once("db.php");

function get_confiserie_info_by_boutique_id($idBoutique){
    $infoConfiserie = requete("SELECT c.id, c.nom, c.type, c.prix, c.illustration, c.description, s.quantite
    FROM confiseries c
    JOIN stocks s ON c.id = s.confiserie_id
    JOIN boutiques b ON s.boutique_id = b.id
    WHERE b.id = $idBoutique ");
    
    return $infoConfiserie;
}
function get_nom_boutique_by_id($idBoutique){
    $infoBoutique = requete("SELECT * from boutiques where id = $idBoutique");
    return $infoBoutique;
}

function get_bonbon_info_by_id($id){
    $infoBonbon = requete("SELECT * from confiseries where id = $id");
    return $infoBonbon;
}

function get_all_boutique(){
    $boutiques = requete("SELECT * from boutiques ");
    return $boutiques;
}

function get_quantite_by_id($idBoutique,$idBonbon){
    $quantite = requete("SELECT quantite
    FROM stocks
    WHERE boutique_id = $idBoutique AND confiserie_id = $idBonbon");
    return $quantite;
}

function get_boutiques_by_user_id($user_id) {
    $boutiques = requete("SELECT * FROM boutiques WHERE utilisateur_id = :user_id", array(':user_id' => $user_id));
    return $boutiques;
}


/* test */

function get_all_confiseries() {
    $confiseries = requete("SELECT * FROM confiseries");
    return $confiseries;
}

function add_stock($boutique_id, $confiserie_id, $quantite) {
    global $PDO;
    $stmt = $PDO->prepare("INSERT INTO stocks (quantite, date_de_modification, boutique_id, confiserie_id) 
                           VALUES (:quantite, NOW(), :boutique_id, :confiserie_id)
                           ON DUPLICATE KEY UPDATE quantite = quantite + VALUES(quantite), date_de_modification = NOW()");
    $stmt->execute([':quantite' => $quantite, ':boutique_id' => $boutique_id, ':confiserie_id' => $confiserie_id]);
}
function delete_stock($boutique_id, $confiserie_id) {
    global $PDO;
    $stmt = $PDO->prepare("DELETE FROM stocks WHERE boutique_id = :boutique_id AND confiserie_id = :confiserie_id");
    $stmt->execute([':boutique_id' => $boutique_id, ':confiserie_id' => $confiserie_id]);
}

function get_confiseries_by_boutique_id($boutique_id) {
    $confiseries = requete("SELECT c.id, c.nom, s.quantite FROM confiseries c
                            JOIN stocks s ON c.id = s.confiserie_id
                            WHERE s.boutique_id = :boutique_id", [':boutique_id' => $boutique_id]);
    return $confiseries;
}


/* ------ */



?>
