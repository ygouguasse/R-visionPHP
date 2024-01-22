<?php $titre = 'Soumissions en attente'; ?>

<?php ob_start(); ?>

<div class="row g-3">

<?php
while($soumission = $reqSoumissions->fetch()) {
  $src = '/images/' . $soumission['nom_image'];
?>

<div class="col-sm-6 col-md-4">
  <div class="card h-100">
    <img src="<?php echo $src ?>" class="card-img-top" alt="<?php out($soumission['nom']); ?>">
    <div class="card-body">
      <h5 class="card-title"><?php out($soumission['nom']); ?></h5>
    </div>
  </div>
</div>

<?php } ?>
<?php $reqSoumissions->closeCursor(); ?>
</div>

<?php $contenu = ob_get_clean(); ?>

<?php require 'vues/gabarit.php'; ?>