<?php
session_start();
include_once("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = md5($_POST['password']); 

    $stmt = $PDO->prepare("SELECT * FROM utilisateurs WHERE username = :username AND password = :password");
    $stmt->bindParam(':username', $user);
    $stmt->bindParam(':password', $pass);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['username'] = $user;
        echo "Connexion réussie !";
        header("Location: index.php");
        exit;
    } else {
        echo '<script>alert("Nom d`utilisateur ou mot de passe incorrect.")</script>'; 
    }
}
?>
