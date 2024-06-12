<?php
include_once("db.php");


function get_confiserie_info_by_boutique_id($idBoutique){
    $infoConfiserie = requete("SELECT c.id, c.nom, c.type, c.prix, c.illustration, c.description
    FROM confiseries c
    JOIN stocks s ON c.id = s.confiserie_id
    JOIN boutiques b ON s.boutique_id = b.id
    WHERE b.id = $idBoutique ");
    return $infoConfiserie;
}
function get_nom_boutique_by_id($idBoutique){
    $infoBoutique = requete("SELECT * from boutiques where id = $idBoutique");
    $nomBoutique = $infoBoutique[0]["nom"];
    return $nomBoutique;
}

function get_bonbon_info_by_id($id){
    $infoBonbon = requete("SELECT * from confiseries where id = $id");
    return $infoBonbon;
}

function get_all_boutique(){
    $boutiques = requete("SELECT * from boutiques ");
    return $boutiques;
}


?>
