<?php

function validerChampsDemandeSoumission()
{
  if (empty($_POST['nom'])) {
    return false;
  }
  if (strlen($_POST['nom']) < 3 || strlen($_POST['nom']) > 50) {
    return false;
  }

  if (empty($_POST['telephone'])) {
    return false;
  }
  if (!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $_POST['telephone'])) {
    return false;
  }

  if (empty($_POST['ville'])) {
    return false;
  }
  if (strlen($_POST['ville']) < 3 || strlen($_POST['ville']) > 255) {
    return false;
  }

  if (empty($_POST['niv'])) {
    return false;
  }
  if (strlen($_POST['niv']) < 3 || strlen($_POST['niv']) > 17) {
    return false;
  }

  return true;
}

function ajouterDemandeSoumission()
{
  if (!validerTypeUtilisateur('client')) {
    header("Location: /authentification/connexion");
    return;
  }

  if (!validerChampsDemandeSoumission()) {
    header("Location: /soumission/demande-soumission?erreur=champs");
    return;
  }

  $images = validerImagesDemandeSoumission();
  if (isset($images['erreur'])) {
    header("Location: /soumission/demande-soumission?erreur=" . $images['erreur']);
    return;
  }

  $demandesSoumissionId = ModeleDemandesSoumission::ajouterDemandesSoumission($_SESSION['utilisateur']['id'], $_POST['nom'], $_POST['telephone'], $_POST['ville'], $_POST['niv']);
  foreach ($images as $image) {
    ModeleImagesDemandeSoumission::ajouterImage($image['nom'], $image['extension'], $demandesSoumissionId);
  }

  header("Location: /soumission/demande-soumission");
}
