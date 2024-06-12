<?php 
/* $bgClass = "bg-index"; */

include_once("head.php");
?>

<div class="div-formConnexion">
<form class="form-connexion" method="POST" action="login.php">
  <div class="title-connexion">Bienvenu(e),<br><span class="grise">veuillez vous connectez pour continuer</span></div>
  <input class="input" name="username" placeholder="username" type="text" required>
  <input class="input" name="password" placeholder="Password" type="password" required>
  <button class="button-confirm" type="submit">Connexion →</button>
</form>
</div>

