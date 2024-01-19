<?php
require_once 'router.php';
require_once 'controleurs/controleur.php';

try {
  get('/', "afficherPageAccueil");

  get('/authentification/connexion', "afficherPageConnexion");
  get('/api/authentification/connexion', "connecter");
  get('/api/authentification/deconnexion', "deconnecter");
  get('/authentification/inscription', "afficherPageinscription");
  get('/api/authentification/inscription', "inscrire");

  get('/soumission/demande-soumission', "afficherPageDemandeSoumission");
  post('/api/soumission/demande-soumission', "ajouterDemandeSoumission");
  get('/soumission/soumissions-en-attente', "afficherPageSoumissionsEnAttente");

  get('/images/$nom', "obtenirImage"); // /images/pikachu -> obtenirImage(pikachu)

  http_response_code(404);
  throw new Exception('Aucune page spécifique demandée');
} catch (PDOException $e) {
  afficherPageErreur($e->getMessage());
} catch (Exception $ex) {
  afficherPageErreur($ex->getMessage());
}
