<?php $titre = 'Obtenir une soumission'; ?>

<?php ob_start(); ?>

<?php
if (!empty($_GET['erreur'])) { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    Une erreur s'est produite veuillez réessayer.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php } ?>


<form class="needs-validation" action="/api/soumission/demande-soumission" method="post" enctype="multipart/form-data" novalidate>
  <div class="input-group has-validation mb-3">
    <span class="input-group-text"><label for="input-nom">Nom</label></span>
    <input type="text" class="form-control" id="input-nom" name="nom" minlength="3" maxlength="50" required>
    <div class="invalid-feedback">
      Veuillez entrer le nom du propriétaire inscrit sur les immatriculations.
    </div>
  </div>

  <div class="input-group has-validation mb-3">
    <span class="input-group-text"><label for="input-telephone">Téléphone</label></span>
    <input type="tel" class="form-control" id="input-telephone" name="telephone" placeholder="123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
    <div class="invalid-feedback">
      Veuillez respecter le format : 123-456-7890.
    </div>
  </div>

  <div class="input-group has-validation mb-3">
    <span class="input-group-text"><label for="input-ville">Ville</label></span>
    <input type="text" class="form-control" id="input-ville" name="ville" minlength="3" maxlength="255" required>
    <div class="invalid-feedback">
      Veuillez entrer la ville inscrite sur les immatriculations.
    </div>
  </div>

  <div class="input-group has-validation mb-3">
    <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="right" title="Le N.I.V. (numéro d'identification du véhicule) est le numéro de série de la voiture. Il est inscrit sur votre certificat d'immatriculation."><label for="input-niv">N.I.V.</label></span>
    <input type="text" class="form-control" id="input-niv" name="niv" minlength="3" maxlength="17" required>
    <div class="invalid-feedback">
      Le N.I.V. (numéro d'identification du véhicule) est le numéro de série de la voiture. Il est inscrit sur votre certificat d'immatriculation.
    </div>
  </div>

  <div class="input-group mb-3">
    <label class="input-group-text" for="input-images">Image(s)</label>
    <input type="file" class="form-control" id="input-images" name="images[]" accept="image/png, image/jpeg" multiple required>
    <div class="invalid-feedback">
      Veuillez sélectionner au moins une image. <br>
      Les images doivent être au format .png ou .jpg. <br>
      La taille maximale de chaques images est de 3 MB.
    </div>
  </div>

  <div class="">
    <button class="btn btn-primary w-100" type="submit">Demander une soumission</button>
  </div>
</form>

<script src="/js/validationFormulaire.js"></script>

<?php $contenu = ob_get_clean(); ?>

<?php require 'vues/gabarit.php'; ?>