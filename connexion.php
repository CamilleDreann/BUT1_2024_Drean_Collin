<?php
$bgClass = "bg-index";
include_once("head.php");
?>

<div class="div-formConnexion">
  <div class="tabs">
    <button class="tab-link button-confirm" onclick="openForm(event, 'Connexion')">Connexion</button>
    <button class="tab-link button-confirm" onclick="openForm(event, 'Inscription')">Inscription</button>
  </div>

  <div id="Connexion" class="tab-content">
    <form class="form-connexion" method="POST" action="login.php">
      <div class="title-connexion">Heureux de vous revoir,<br><span class="grise">veuillez vous connectez pour continuer</span></div>

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

  <div id="Inscription" class="tab-content" style="display:none;">
    <form class="form-inscription" method="POST" action="register.php">
      <div class="title-inscription">Bienvenu(e),<br><span class="grise">veuillez remplir les champs ci-dessous</span></div>

      <?php
        if (isset($_SESSION["error"])) {
          echo '<p class="error-message">' . $_SESSION["error"] . '</p>';
          unset($_SESSION["error"]);
        }
      ?>

      <input class="input" name="username" placeholder="Username" type="text" required>
      <input class="input" name="password" placeholder="Password" type="password" required>
      <input class="input" name="email" placeholder="Email" type="email" required>
      <input class="input" name="prenom" placeholder="Prénom" type="text" required>
      <input class="input" name="nom" placeholder="Nom" type="text" required>
      <input class="input" name="ddn" placeholder="Date de naissance (YYYY-MM-DD)" type="date" required>
      <button class="button-confirm" type="submit">S'inscrire →</button>
    </form>
  </div>
</div>

<script>
function openForm(evt, formName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tab-content");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tab-link");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(formName).style.display = "block";
  evt.currentTarget.className += " active";
}

/* ouvre par défault "connexion" */
document.getElementsByClassName("tab-link")[0].click();
</script>

<?php include_once("footer.php"); ?>
