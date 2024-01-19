<?php

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

function validerCourriel($courriel)
{
  if (strlen($courriel) > 50) {
    return false;
  }
  if (!preg_match("/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/", $courriel)) {
    return false;
  }

  return true;
}

function validerChampsAuthentification()
{
  if (empty($_POST['courriel'])) {
    return false;
  }

  if (!validerCourriel($_POST['courriel'])) {
    return false;
  }

  if (empty($_POST['motDePasse'])) {
    return false;
  }
  if (strlen($_POST['motDePasse']) < 12 || strlen($_POST['motDePasse']) > 20) {
    return false;
  }
  if (!preg_match("/^(?=.*([\p{Ll}\p{M}].*){2})(?=.*([\p{Lu}\p{M}].*){2})(?=.*(\d.*){2})(?=.*([@$!%*#?&].*){2})[\p{L}\p{M}\d@$!%*#?&]{12,20}$/u", $_POST['motDePasse'])) {
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

    ModeleUtilisateurs::ajouterUtilisateur($_POST['courriel'], password_hash($_POST['motDePasse'], PASSWORD_DEFAULT));
    connecter();
}

function connecter()
{
  if (!validerChampsAuthentification()) {
    header("Location: /authentification/connexion");
    return;
  }

  $reqUtilisateur = ModeleUtilisateurs::obtenirUtilisateur($_POST['courriel'], $_POST['motDePasse']);
  $utilisateur = $reqUtilisateur->fetch();
  $reqUtilisateur->closeCursor();

  if (!$utilisateur) {
    header("Location: /authentification/connexion");
    return;
  }

  if (password_verify($_POST['motDePasse'], $utilisateur['motDePasse'])) {
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
  header('Content-Type: application/json; charset=utf-8');

  if (!validerCourriel($courriel)) {
    echo json_encode(["courrielDisponible"=>false]);
    return;
  }

  $reqUtilisateur = ModeleUtilisateurs::obtenirUtilisateur($courriel);
  $utilisateur = $reqUtilisateur->fetch();
  $reqUtilisateur->closeCursor();

  if ($utilisateur) {
    echo json_encode(["courrielDisponible"=>false]);
    return;
  }

  echo json_encode(["courrielDisponible"=>true]);
}

function deconnecter()
{
  session_unset();
  session_destroy();
  header("Location: /");
}

demarrerSession();
