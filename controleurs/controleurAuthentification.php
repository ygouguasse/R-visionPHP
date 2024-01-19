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
  header('Content-Type: application/json; charset=utf-8');
   if (!$courriel) {
      // header("Location: index.php?action=Connexion&erreur=identifiants");
      http_response_code(400);
      echo json_encode(["erreur"=> "autreErreur"]);
      return;
  }
  $reqUtilisateur = ModeleUtilisateurs::obtenirUtilisateur($courriel);
  $utilisateur = $reqUtilisateur->fetch();
  $reqUtilisateur->closeCursor();

  if ($utilisateur) {
    http_response_code(400);
    echo json_encode(["erreur"=> "erreur"]);
    return;
  }

 // echo json_encode(["succes"=> "succes"]);

}

function deconnecter()
{
  session_unset();
  session_destroy();
  header("Location: /");
}

demarrerSession();
