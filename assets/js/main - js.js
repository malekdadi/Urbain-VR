
function validerFormulaire() {
   
  var nom = document.getElementById("nom").value;
  var prenom = document.getElementById("prenom").value;
  var mdp = document.getElementById("mdp").value;
  var email = document.getElementById("email").value;
 

  
  if (nom.length < 3) {
      alert("The name must contain at least 3 characters.");
      return false;
  }
  if (prenom.length < 3) {
    alert("The lastname must contain at least 3 characters.");
    return false;
}
if (mdp.length < 6) {
  erreurs.push("Le mot de passe doit contenir au moins 6 caractères.");
}

const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
if (!emailRegex.test(email)) {
  erreurs.push("L'adresse email est invalide.");
}
  
 

 

  
  alert("Form successfully submitted !");
  return true;
} 

// Partie 2


document.getElementById("addUserForm").addEventListener("submit", function(event) {
    
  event.preventDefault();
  

  var nom = document.getElementById("nom").value;
  var prenom = document.getElementById("prenom").value;
  var mdp = document.getElementById("mdp").value;
  var email = document.getElementById("email").value;
  var isValid = true;

  // Fonction pour afficher les messages d'erreur ou de succès
  function displayMessage(id, message, isError) {
      var element = document.getElementById(id + "_error");
      element.style.color = isError ? "red" : "green";
      element.innerText = message;
  }

  // Vérification du nom
  if (nom.length < 3) {
      displayMessage("title", "The name must contain at least 3 characters.", true);
      isValid = false;
  } else {
      displayMessage("title", "Correct", false);
  }
  // Vérification du prenom
  if (prenom.length < 3) {
    displayMessage("title", "The lastname must contain at least 3 characters.", true);
    isValid = false;
} else {
    displayMessage("title", "Correct", false); 
}
  // Vérification du mdp
if (mdp.length < 6) {
  displayMessage("title", "The password must contain at least 6 characters.", true);
  isValid = false;
} else {
  displayMessage("title", "Correct", false);
}




  // Vérification de l'email
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
      displayMessage("email", "l'mail must contains @", true);
      isValid = false;
  } else {
      displayMessage("email", "Correct", false);
  }


  }
