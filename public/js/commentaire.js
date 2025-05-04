document.getElementById('commentaireForm').addEventListener('submit', function(e) {
    e.preventDefault();

    // Réinitialiser les erreurs
    document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
    document.querySelectorAll('input, textarea').forEach(el => el.classList.remove('error'));

    let isValid = true;
    const nom         = document.getElementById('nom').value.trim();
    const email       = document.getElementById('email').value.trim();
    const commentaire = document.getElementById('commentaire').value.trim();

    // Validation du nom
    if (nom === '') {
        document.getElementById('nomError').textContent = 'Le nom est requis';
        document.getElementById('nom').classList.add('error');
        isValid = false;
    }

    // Validation de l'email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        document.getElementById('emailError').textContent = 'Email invalide';
        document.getElementById('email').classList.add('error');
        isValid = false;
    }

    // Validation du commentaire
    if (commentaire === '') {
        document.getElementById('commentaireError').textContent = 'Le commentaire est requis';
        document.getElementById('commentaire').classList.add('error');
        isValid = false;
    } else if (commentaire.length < 10) {
        document.getElementById('commentaireError').textContent = 'Le commentaire doit contenir au moins 10 caractères';
        document.getElementById('commentaire').classList.add('error');
        isValid = false;
    }

    if (isValid) {
        this.submit();
    }
});
