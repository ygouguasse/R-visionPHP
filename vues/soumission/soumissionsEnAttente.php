<?php $titre = 'Soumissions en attente'; ?>

<?php ob_start(); ?>

<div class="col-sm-6 col-md-4">
  <div class="card h-100">
    <img src="https://upload.wikimedia.org/wikipedia/commons/4/4b/Tractionfr02.jpg" class="card-img-top" alt="Citroën Traction Avant">
    <div class="card-body">
      <h5 class="card-title">Citroën Traction Avant</h5>
    </div>
  </div>
</div>

<?php $contenu = ob_get_clean(); ?>

<?php require 'vues/gabarit.php'; ?>