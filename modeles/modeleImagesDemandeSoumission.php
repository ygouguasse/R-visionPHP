<?php

require_once "modeles/bd.php";

class ModeleImagesDemandeSoumission
{
  public static function obtenirImage($nom)
  {
    $req = BD::ObtenirConnexion()->prepare(
      "SELECT * FROM images_demande_soumission WHERE nom = :nom"
    );

    $req->bindParam("nom", $nom, PDO::PARAM_STR);
    $req->execute();

    return $req;
  }



  
  public static function ajouterImage($nom, $extension, $demandesSoumissionId)
  {
    $sql = 'INSERT INTO images_demande_soumission
            (nom, extension, demandes_soumission_id)
            VALUES  (:nom, :extension, :demandes_soumission_id)';

    $requete = BD::ObtenirConnexion()->prepare($sql);
    $requete->bindparam('nom', $nom, PDO::PARAM_STR);
    $requete->bindparam('extension', $extension, PDO::PARAM_STR);
    $requete->bindparam('demandes_soumission_id', $demandesSoumissionId, PDO::PARAM_INT);
    $requete->execute();

    return $requete;
  }
}
