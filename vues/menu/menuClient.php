<?php
if (validerTypeUtilisateur("client")) {
?>

  <li class="nav-item">
    <a class="nav-link <?php NavClass("/soumission/demande-soumission"); ?>" href="/soumission/demande-soumission">Demander une soumission</a>
  </li>

<?php } ?>