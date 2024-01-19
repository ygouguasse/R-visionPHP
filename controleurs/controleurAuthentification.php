<?php
require('modele/modeleUtilisateurs.php');
function demarrerSession()
{
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
}

function validerUtilisateurConnecte()
{
  return isset($_SESSION['utilisateur']);
}

function validerTypeUtilisateur($type)
{
  return isset($_SESSION['utilisateur']['type']) &&
    $_SESSION['utilisateur']['type'] === $type;
}

function validerChampsAuthentification()
{
  if (empty($_POST['courriel'])) {
    return false;
  }

  if (empty($_POST['motDePasse'])) {
    return false;
  }

  return true;
}

function inscrire()
{
  if (!validerChampsAuthentification()) {
    header("Location: /authentification/inscription");
    return;
  }

    ModeleUtilisateurs::ajouterUtilisateur($_POST['courriel'], $_POST['motDePasse']);
    connecter();
}

function connecter()
{
  if (!validerChampsAuthentification()) {
    header("Location: /authentification/connexion");
    return;
  }

  $reqUtilisateur = ModeleUtilisateurs::obtenirUtilisateur($_POST['courriel']);
  $utilisateur = $reqUtilisateur->fetch();
  $reqUtilisateur->closeCursor();

  if (!$utilisateur) {
    header("Location: /authentification/connexion");
    return;
  }

if (password_verify($_POST['motDePasse'],$utilisateur['motDePasse'])) {
  
  demarrerSession();
  
  $_SESSION['utilisateur'] = [
      'id' => $utilisateur['id'],
      'courriel' => $utilisateur['courriel'],
      'type' => $utilisateur['type']
    ];
    header("Location: /");
  } else {
    header("Location: /authentification/connexion");
  }
}

function verifierCourrielDisponible($courriel)
{
}

function deconnecter()
{
  session_unset();
  session_destroy();
  header("Location: /");
}

demarrerSession();
