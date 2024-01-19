<nav class="navbar navbar-expand-md bg-body-tertiary sticky-top">
  <div class="container-xxl">
    <a class="navbar-brand" href="/">
      <svg height="40" viewBox="0 0 240 80" xmlns="http://www.w3.org/2000/svg" role="img">
        <style>
          .small {
            font: italic 13px sans-serif;
          }

          .heavy {
            font: bold 30px sans-serif;
          }

          .Rrrrr {
            font: italic 40px serif;
            fill: white;
            text-shadow: 0 0 8px #000000;
          }
        </style>

        <title>Ton char, on l'achète!</title>
        <text x="20" y="35" class="small">Ton</text>
        <text x="40" y="35" class="heavy">char,</text>
        <text x="55" y="55" class="small">on</text>
        <text x="70" y="55" class="Rrrrr">l'achète!</text>
      </svg>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Navigation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-start flex-grow-1 pe-3">
          <?php require_once 'vues/menu/menuClient.php'; ?>
          <?php require_once 'vues/menu/menuVendeur.php'; ?>
        </ul>
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <?php require_once 'vues/menu/menuAuthentification.php'; ?>
        </ul>
      </div>
    </div>
  </div>
</nav>

<?php
function NavClass($menu)
{
  $requete = $_SERVER['REQUEST_URI'];
  if ($requete === $menu) {
    echo ' active ';
  }
}
?>