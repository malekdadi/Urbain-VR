document.addEventListener('DOMContentLoaded', function() {
    // Vérifier d'abord si le formulaire existe
    const form = document.getElementById('reclamationForm');
    
    if (!form) {
        console.error("Le formulaire avec l'ID 'reclamationForm' n'a pas été trouvé");
        return;
    }

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Récupérer les éléments
        const nom = document.getElementById('nom');
        const email = document.getElementById('email');
        const message = document.getElementById('message');
        
        // Vérifier si les éléments existent
        if (!nom || !email || !message) {
            console.error("Un ou plusieurs champs du formulaire n'ont pas été trouvés");
            return;
        }

        let isValid = true;
        
        // Validation du nom
        if (nom.value.trim() === '') {
            document.getElementById('nomError').textContent = 'Le nom est requis.';
            isValid = false;
        } else {
            document.getElementById('nomError').textContent = '';
        }

        // Validation de l'email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email.value.trim())) {
            document.getElementById('emailError').textContent = 'Email invalide.';
            isValid = false;
        } else {
            document.getElementById('emailError').textContent = '';
        }

        // Validation du message
        if (message.value.trim().length < 10) {
            document.getElementById('messageError').textContent = 'Le message doit contenir au moins 10 caractères.';
            isValid = false;
        } else {
            document.getElementById('messageError').textContent = '';
        }

        // Si tout est valide, soumettre le formulaire
        if (isValid) {
            form.submit();
        }
    });
});