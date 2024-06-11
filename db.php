<?php

// Si vous voulez éviter les problèmes vous devez ignorer ce fichier en l'ajoutant au .gitignore

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

const DB_DRIVER = 'mysql';
const DB_HOST = '127.0.0.1';
const DB_PORT = 3306;
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_DATABASE = 'sae203'; // Nom de votre base de données

try {
    $PDO = new PDO(
        DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';port=' . DB_PORT,
        DB_USERNAME,
        DB_PASSWORD
    );
} catch (Exception $ex) {
    echo ($ex->getMessage());
    die;
}

/*
* requete() est une fonction basique pour interroger la base de donnée définie au dessus.
* Il vous est demandé d'utiliser les fonctions préparées avec PDO, voir la doc officielle
* donc cette fonction ne sera pas suffisante, vous devrez en créer d'autres plus pertinentes.
*
* Pour éviter les conflits il est plus pertinent d'écrire les nouvelles fonctions dans un autre fichier
*/

function requete($sql){
    global $PDO;
    $stmt = $PDO->query($sql);
    return $stmt->fetchAll();
}