<?php

require_once "modeles/bd.php";

class ModeleDemandesSoumission
{
  public static function ajouterDemandesSoumission($utilisateurId, $nom, $telephone, $ville, $niv)
  {
    $sql = 'INSERT INTO demandes_soumission
            (utilisateur_id, nom, telephone, ville, niv)
            VALUES  (:utilisateur_id, :nom, :telephone, :ville, :niv)';

    $connexion = BD::ObtenirConnexion();
    $requete = $connexion->prepare($sql);
    $requete->bindparam('utilisateur_id', $utilisateurId, PDO::PARAM_INT);
    $requete->bindparam('nom', $nom, PDO::PARAM_STR);
    $requete->bindparam('telephone', $telephone, PDO::PARAM_STR);
    $requete->bindparam('ville', $ville, PDO::PARAM_STR);
    $requete->bindparam('niv', $niv, PDO::PARAM_STR);
    $requete->execute();

    return $connexion->lastInsertId();
  }

  public static function obtenirDemandesSoumissionEnAttente()
  {
    $sql = 'SELECT  demandes_soumission.*,
                    images_demande_soumission.nom as nom_image,
                    images_demande_soumission.extension as extension_image
            FROM demandes_soumission
            LEFT JOIN soumissions
              ON demandes_soumission.id = soumissions.demandes_soumission_id
            INNER JOIN images_demande_soumission
              ON demandes_soumission.id = images_demande_soumission.demandes_soumission_id
            WHERE soumissions.id IS NULL
            GROUP BY demandes_soumission.id';

    $requete = BD::ObtenirConnexion()->prepare($sql);
    $requete->execute();

    return $requete;
  }
}
