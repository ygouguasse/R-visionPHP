<?php
if (validerUtilisateurConnecte()) { ?>

  <li class="nav-item">
    <a class="nav-link" href="/api/authentification/deconnexion">Déconnexion</a>
  </li>

<?php } else { ?>

  <li class="nav-item">
    <a class="nav-link <?php NavClass("/authentification/connexion"); ?>" href="/authentification/connexion">Connexion</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php NavClass("/authentification/inscription"); ?>" href="/authentification/inscription">Inscription</a>
  </li>

<?php } ?>