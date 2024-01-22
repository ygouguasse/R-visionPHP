<?php $titre = 'Soumissions en attente'; ?>

<?php ob_start(); ?>


<?php
while ($fichier = $reqSoumissions->fetch()) { ?>

<div class="col-sm-6 col-md-4">
  <div class="card h-100">
    <img src="/images/" + <?php echo $fichier['nom_image']; ?> class="card-img-top" alt="Citroën Traction Avant"> 
    <div class="card-body">
      <h5 class="card-title">Citroën Traction Avant</h5>
    </div>
  </div>
</div>

<?php }
?>

<?php $contenu = ob_get_clean(); ?>

<?php require 'vues/gabarit.php'; ?>