<?php $titre = 'Connexion'; ?>

<?php ob_start(); ?>

<form method="POST" class="needs-validation" action="/api/authentification/connexion" novalidate>
  <div class="form-floating mb-3">
    <input type="courriel" class="form-control" id="input-courriel" name="courriel" placeholder="name@example.com" maxlength="50" pattern="[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}" required>
    <label for="input-courriel">Courriel</label>
  </div>

  <div class="form-floating mb-3">
    <input type="password" class="form-control" id="input-motDePasse" name="motDePasse" placeholder="Mot de passe" maxlength="20" pattern="(?=.*([\p{Ll}\p{M}].*){2})(?=.*([\p{Lu}\p{M}].*){2})(?=.*(\d.*){2})(?=.*([@$!%*#?&].*){2})[\p{L}\p{M}\d@$!%*#?&]{12,20}" required>
    <label for="input-motDePasse">Mot de passe</label>
    <div class="invalid-feedback">
      Entre 12 et 20 caractères. <br>
      Seul les lettres minuscules, les lettres majuscules, les chiffres, @, $, !, %, *, #, ? et & sont autorisés. <br>
      Au moins 2 lettres minucules. <br>
      Au moins 2 lettres majuscules. <br>
      Au moins 2 chiffres. <br>
      Au moins 2 caractères spéciaux parmi : @, $, !, %, *, #, ? et &.
    </div>
  </div>

  <div class="">
    <button class="btn btn-primary w-100" type="submit">Se connecter</button>
  </div>
</form>

<script src="/js/validationFormulaire.js"></script>

<?php $contenu = ob_get_clean(); ?>

<?php require 'vues/gabarit.php'; ?>