window.addEventListener('load', initialiser);

function initialiser() {
  document
    .getElementById('input-confirmationMotDePasse')
    .addEventListener('input', validerConfirmationMotDePasse);
  document
    .getElementById('input-courriel')
    .addEventListener('blur', verifierCourrielDisponible);
}

function validerConfirmationMotDePasse(event) {
  event.target.setCustomValidity('');

  if (
    event.target.value !== document.getElementById('input-motDePasse').value
  ) {
    event.target.setCustomValidity('Les mots de passe ne correspondent pas');
  }
}

async function verifierCourrielDisponible(event) {
  const courriel = event.target.value;

  if (courriel.length < 3) {
    return;
  }
  if (courriel.match(/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/) === null) {
    return;
  }

  try {
    const reponse = await fetch(
      '/api/authentification/courriel-disponible/' + courriel
    );

    if (!reponse.ok) {
      throw new Error('Erreur lors de la requête');
    }

    const reponseJson = await reponse.json();

    if (reponseJson.courrielDisponible) {
      event.target.setCustomValidity('');
    } else {
      event.target.setCustomValidity('Ce courriel est déjà utilisé');
    }
  } catch (error) {
    console.error(error);
  }
}
