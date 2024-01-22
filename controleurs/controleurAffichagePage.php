<?php

function afficherPageAccueil() {
  require 'vues/accueil.php';
}

function afficherPageConnexion() {
  require 'vues/authentification/connexion.php';
}

function afficherPageDemandeSoumission() {
  if (!validerTypeUtilisateur('client')) {
    header('Location: /authentification/connexion');
    return;
  }
  require 'vues/soumission/demandeSoumission.php';
}

function afficherPageSoumissionsEnAttente() {
  if (!validerTypeUtilisateur('vendeur')) {

   
    header('Location: /authentification/connexion');
    return;
  }

  $reqSoumissions = ModeleDemandesSoumission::obtenirDemandesSoumissionEnAttente();

  require 'vues/soumission/soumissionsEnAttente.php';
}

function afficherPageInscription() {
  require 'vues/authentification/inscription.php';
}

function afficherPageErreur($msgErreur) {
  require 'vues/erreur.php';
}

?>