<?php
session_start();
include_once("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $email = $_POST['email'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $ddn = $_POST['ddn'];

    $stmt = $PDO->prepare("SELECT * FROM utilisateurs WHERE username = :username OR email = :email");
    $stmt->execute([':username' => $username, ':email' => $email]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['error'] = "Nom d'utilisateur ou email déjà utilisé.";
        header("Location: inscription.php");
        exit;
    }

    $stmt = $PDO->prepare("INSERT INTO utilisateurs (username, password, email, role, prenom, nom, ddn) VALUES (:username, :password, :email, 'client', :prenom, :nom, :ddn)");
    $stmt->execute([
        ':username' => $username,
        ':password' => $password,
        ':email' => $email,
        ':prenom' => $prenom,
        ':nom' => $nom,
        ':ddn' => $ddn
    ]);

    $_SESSION['username'] = $username;
    $_SESSION['role'] = 'client';
    $_SESSION['user_id'] = $PDO->lastInsertId(); 

    header("Location: index.php");
    exit;
}
?>
