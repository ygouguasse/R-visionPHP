window.addEventListener('load', initialiser);

function initialiser() {
  document
    .getElementById('input-confirmationMotDePasse')
    .addEventListener('input', validerConfirmationMotDePasse);
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

}
