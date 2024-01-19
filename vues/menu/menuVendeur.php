<?php
if (validerTypeUtilisateur("vendeur")) {
?>

  <li class="nav-item">
    <a class="nav-link <?php NavClass("/soumission/soumissions-en-attente"); ?>" href="/soumission/soumissions-en-attente">Soumissions en attentes</a>
  </li>

<?php } ?>