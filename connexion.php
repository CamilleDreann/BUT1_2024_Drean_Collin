<?php
$bgClass = "bg-index";

include_once ("head.php");
?>



<div class="div-formConnexion">
  <form class="form-connexion" method="POST" action="login.php">
    <div class="title-connexion">Bienvenu(e),<br><span class="grise">veuillez vous connectez pour continuer</span></div>

    <?php
      if (isset($_SESSION["error"])) {
        echo '<p class="error-message">' . $_SESSION["error"] . '</p>';
        unset($_SESSION["error"]);
      }
      ?>

    <input class="input" name="username" placeholder="Username" type="text" required>
    <input class="input" name="password" placeholder="Password" type="password" required>
    <button class="button-confirm" type="submit">Connexion →</button>
  </form>
</div>