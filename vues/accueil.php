<?php $titre = 'Accueil'; ?>

<?php ob_start(); ?>

<h1>Révision web</h1>

<?php $contenu = ob_get_clean(); ?>

<?php require 'vues/gabarit.php'; ?>