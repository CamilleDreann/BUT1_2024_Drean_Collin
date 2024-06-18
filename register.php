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

    $stmt = $PDO->prepare("INSERT INTO utilisateurs (username, password, email, role, prenom, nom, ddn) 
                           VALUES (:username, :password, :email, 'client', :prenom, :nom, :ddn)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':ddn', $ddn);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Inscription réussie. Vous pouvez maintenant vous connecter.";
        header("Location: connexion.php");
        exit;
    } else {
        $_SESSION['error'] = "Erreur lors de l'inscription. Veuillez réessayer.";
        header("Location: connexion.php");
        exit;
    }
}
?>
