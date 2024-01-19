window.addEventListener('load', initialiser);

function initialiser() {
  document.getElementById('input-confirmationMotDePasse')
    .addEventListener('input', validerConfirmationMotDePasse);
    document.getElementById('input-courriel')
    .addEventListener('input', verifierCourrielDisponible);

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

  
  event.preventDefault();
  event.stopPropagation();

 // if(!formulaire.checkValidity()) { return; }

  const courriel = event.currentTarget.value;

  //const donnees = new FormData();
  //donnees.append("emailSaisi", emailSaisi);
  
  try {
    const reponse = await fetch("/api/authentification/courriel-disponible/"+courriel, {
      //  method: "POST",
       // body: donnees
    });

    if (!reponse.ok) {
        const resultat = await reponse.json();
        if (resultat["erreur"] === "erreur") {
            document.getElementById("conteneurAlerte").innerHTML = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Email Existe déjà.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            `;
        } else {
            document.getElementById("conteneurAlerte").innerHTML = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Email erreur
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            `;
        }
        
        return;
    }

    //window.location = "/authentification/inscription";

} catch (error) {
    document.getElementById("conteneurAlerte").innerHTML = `
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Une erreur est survenue, veuillez réessayer.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
}



}
