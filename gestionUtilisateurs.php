<?php

/* c'est pour démarrer la mise en tampon c'est ça qui fesait bugger mon code, en gros cela fait que c'est la sortie est fait par le script et non pas le navigateur directement */
ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once("db.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$utilisateurs = requete("SELECT id, username, email, role FROM utilisateurs");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $new_role = $_POST['new_role'];

    try {
        $stmt = $PDO->prepare("UPDATE utilisateurs SET role = :new_role WHERE id = :user_id");
        $stmt->bindParam(':new_role', $new_role);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        $_SESSION['success_message'] = "Le rôle de l'utilisateur a été mis à jour avec succès.";
    } catch (Exception $e) {
        $_SESSION['error_message'] = "Une erreur est survenue lors de la mise à jour du rôle de l'utilisateur.";
    }

    header("Location: gestionUtilisateurs.php");
    exit;
}

$bgClass = "bg-gestion";
include_once("head.php");
?>

<article class="article-gestion">
    <h1 class="titre-gestion">Gestion des utilisateurs</h1>
    
    <?php
    if (isset($_SESSION['success_message'])) {
        echo '<p class="success-message">' . $_SESSION['success_message'] . '</p>';
        unset($_SESSION['success_message']);
    }
    if (isset($_SESSION['error_message'])) {
        echo '<p class="error-message">' . $_SESSION['error_message'] . '</p>';
        unset($_SESSION['error_message']);
    }
    ?>

    <table class="tableau-gestion">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Role actuel</th>
                <th>Nouveau role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($utilisateurs as $utilisateur): ?>
            <tr>
                <form method="POST" action="gestionUtilisateurs.php">
                    <td><?php echo htmlspecialchars($utilisateur['username']); ?></td>
                    <td><?php echo htmlspecialchars($utilisateur['email']); ?></td>
                    <td><?php echo htmlspecialchars($utilisateur['role']); ?></td>
                    <td>
                        <select class="select-gestion" name="new_role">
                            <option value="client" <?php if ($utilisateur['role'] == 'client') echo 'selected'; ?>>Client</option>
                            <option value="gerant" <?php if ($utilisateur['role'] == 'gerant') echo 'selected'; ?>>Gérant</option>
                            <option value="admin" <?php if ($utilisateur['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                        </select>
                    </td>
                    <td>
                        <input type="hidden" name="user_id" value="<?php echo $utilisateur['id']; ?>">
                        <button class="bouton-gestion" type="submit">Mettre à jour</button>
                    </td>
                </form>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</article>

<?php include_once("footer.php"); ?>

<?php
ob_end_flush();
?>