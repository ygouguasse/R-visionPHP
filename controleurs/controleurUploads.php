<?php

function validerImagesDemandeSoumission()
{
  $tailleMaximale = 1024 * 1024 * 3; // 3 MB
  $typesAuthorises = [
    'image/png' => 'png',
    'image/jpeg' => 'jpg'
  ];

  if (!isset($_FILES["images"])) {
    return ['erreur' => 'PasDeFichier'];
  }

  $images = [];

  foreach ($_FILES["images"]['tmp_name'] as $key => $cheminFichier) {
    $infosValidation = validerFichier($cheminFichier, $tailleMaximale, $typesAuthorises);
    if (!empty($infosValidation['erreur'])) {
      return $infosValidation;
    }

    $dossierImages = 'uploads/images/';
    $infosCheminFichier = obtenirCheminFichierUnique($dossierImages, $infosValidation['extension']);
    $nom = $infosCheminFichier['nom'];
    $chemin = $infosCheminFichier['chemin'];
    $extension = $infosValidation['extension'];

    if (!move_uploaded_file($cheminFichier, $chemin)) {
      return ['erreur' => 'erreur'];
    }

    $images[] = ['nom' => $nom, 'extension' => $extension];
  }

  return $images;
}

function obtenirCheminFichierUnique($dossier, $extension)
{
  // Dans un environnement de production, on utiliserait un GUID au lieu de uniqid
  $nouveauNomFichier = uniqid('', true);
  $nouveauCheminFichier = $dossier . $nouveauNomFichier . '.' . $extension;

  while (file_exists($nouveauCheminFichier)) {
    $nouveauNomFichier = uniqid('', true);
    $nouveauCheminFichier = $dossier . $nouveauNomFichier . '.' . $extension;
  }

  return [
    'nom' => $nouveauNomFichier,
    'chemin' => $nouveauCheminFichier,
  ];
}

function validerFichier($cheminFichier, $tailleMaximale, $typesAuthorises)
{
  $tailleFichier = filesize($cheminFichier);
  $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
  $typeFichier = finfo_file($fileinfo, $cheminFichier);

  if ($tailleFichier === 0) {
    return ['erreur' => 'FichierVide'];
  }

  if ($tailleFichier > $tailleMaximale) {
    return ['erreur' => 'FichierTropGros'];
  }

  if (!in_array($typeFichier, array_keys($typesAuthorises))) {
    return ['erreur' => 'TypeFichierNonAuthorise'];
  }

  return [
    'extension' => $typesAuthorises[$typeFichier]
  ];
}

function obtenirImage($nom)
{
  $requeteImage = ModeleImagesDemandeSoumission::obtenirImage($nom);
  $imageInfos = $requeteImage->fetch();
  $requeteImage->closeCursor();

  if (!$imageInfos) {
    http_response_code(404);
    return;
  }

  $nomFichier = $imageInfos['nom'] . '.' . $imageInfos['extension'];
  $cheminFichier = 'uploads/images/' . $nomFichier;

  header('Content-Description: File Transfer');
  header('Content-Type: application/octet-stream');
  header('Content-Disposition: attachment; filename="' . $nomFichier . '"');
  header('Expires: 0');
  header('Cache-Control: must-revalidate');
  header('Pragma: public');
  header('Content-Length: ' . filesize($cheminFichier));
  readfile($cheminFichier);
}
