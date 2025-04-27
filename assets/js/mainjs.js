<script>
document.addEventListener("DOMContentLoaded", function ()  {
    const form = document.getElementById("addUserForm");
    const nomInput = document.getElementById("nom");
    const prenomInput = document.getElementById("prenom");
    const emailInput = document.getElementById("email");
    const mdpInput = document.getElementById("mdp");

    function showFeedback(input, message, isValid) {
        let feedback = input.nextElementSibling;
        if (!feedback || !feedback.classList.contains("form-text")) {
            feedback = document.createElement("div");
            feedback.className = "form-text mt-1";
            input.parentNode.appendChild(feedback);
        }
        feedback.textContent = message;
        feedback.style.color = isValid ? "green" : "red";
    }

    function validateNomPrenom(input) {
        const value = input.value.trim();
        const isValid = value.length >= 3 && /^[A-Z]/.test(value);
        if (!isValid) {
            showFeedback(input, "Doit contenir au moins 3 caractères et commencer par une majuscule.", false);
        } else {
            showFeedback(input, "Nom/prénom valide !", true);
        }
        return isValid;
    }

    function validateEmail(input) {
        const value = input.value.trim();
        const isValid = value.includes("@");
        if (!isValid) {
            showFeedback(input, "Adresse email invalide (manque '@').", false);
        } else {
            showFeedback(input, "Email valide !", true);
        }
        return isValid;
    }

    function validatePassword(input) {
        const value = input.value;
        const isValid = value.length > 6;
        if (!isValid) {
            showFeedback(input, "Mot de passe trop court (minimum 7 caractères).", false);
        } else {
            showFeedback(input, "Mot de passe valide !", true);
        }
        return isValid;
    }

    // Écouteurs d’événements en direct
    nomInput.addEventListener("input", () => validateNomPrenom(nomInput));
    prenomInput.addEventListener("input", () => validateNomPrenom(prenomInput));
    emailInput.addEventListener("input", () => validateEmail(emailInput));
    mdpInput.addEventListener("input", () => validatePassword(mdpInput));

    // Validation finale à la soumission
    form.addEventListener("submit", function (e) {
        const isNomValid = validateNomPrenom(nomInput);
        const isPrenomValid = validateNomPrenom(prenomInput);
        const isEmailValid = validateEmail(emailInput);
        const isMdpValid = validatePassword(mdpInput);

        if (!(isNomValid && isPrenomValid && isEmailValid && isMdpValid)) {
            e.preventDefault(); // Bloque la soumission
        }
    });
});
</script>
