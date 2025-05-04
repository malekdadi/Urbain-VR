<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Ajouter Réclamation - URBA-VR</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f3;
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #2e7d32;
            color: white;
            padding: 20px;
            position: fixed;
            height: 100%;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .sidebar .logo {
            text-align: center;
            margin-bottom: 40px;
        }

        .sidebar .logo img {
            width: 120px;
            border-radius: 8px;
        }

        .sidebar nav a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            margin-bottom: 15px;
            border-radius: 6px;
            font-size: 17px;
            transition: background 0.3s ease, transform 0.2s;
        }

        .sidebar nav a:hover {
            background-color: #43a047;
            transform: translateX(5px);
        }

        .main-content {
            margin-left: 250px;
            padding: 40px;
            width: 100%;
        }

        .header {
            background-color: #388e3c;
            padding: 20px;
            color: white;
            border-radius: 10px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }

        .titre-vert {
            color: #2e7d32;
            font-size: 2.2em;
            text-align: center;
            margin: 30px 0 20px;
        }

        .form-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .input-field {
            width: 100%;
            padding: 14px;
            border: 1px solid #c8e6c9;
            border-radius: 8px;
            font-size: 16px;
            background-color: #f9f9f9;
        }

        .input-field:focus {
            border-color: #66bb6a;
            outline: none;
            background-color: #ffffff;
        }

        textarea.input-field {
            min-height: 120px;
            resize: vertical;
        }

        .error {
            border-color: #d32f2f !important;
        }

        .error-message {
            color: #d32f2f;
            font-size: 0.85em;
            margin-top: 5px;
            display: block;
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            background-color: #43a047;
            border: none;
            color: white;
            font-size: 17px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #388e3c;
        }

        .button-group {
            text-align: center;
            margin-top: 30px;
        }

        .button-group a {
            display: inline-block;
            background-color: #388e3c;
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 30px;
            margin: 0 10px;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .button-group a:hover {
            background-color: #2e7d32;
            transform: scale(1.05);
        }

        .button-group a i {
            margin-right: 8px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="assets/img/logo.jpg" alt="Logo URBA-VR">
        </div>
        <nav>
            <a href="index.php"><i class="fas fa-home"></i> Dashboard</a>
            <a href="index.php?action=index"><i class="fas fa-list"></i> Afficher Réclamations</a>
            <a href="index.php?action=commentaire_add"><i class="fas fa-comment"></i> Ajouter Commentaire</a>
        </nav>
    </div>

    <!-- Contenu principal -->
    <div class="main-content">
        <div class="header">
            URBA-VR 
        </div>

        <h2 class="titre-vert">Ajouter une Réclamation</h2>

        <div class="form-container">
            <form method="POST" id="reclamationForm">
                <div class="form-group">
                    <input type="text" id="nom" name="nom" placeholder="Nom" class="input-field">
                    <span class="error-message" id="nomError"></span>
                </div>
                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="Email" class="input-field">
                    <span class="error-message" id="emailError"></span>
                </div>
                <div class="form-group">
                    <textarea id="message" name="message" placeholder="Message" class="input-field"></textarea>
                    <span class="error-message" id="messageError"></span>
                </div>
                <button type="submit" class="submit-btn"><i class="fas fa-paper-plane"></i> Envoyer la Réclamation</button>
            </form>
        </div>

        <div class="button-group">
            <a href="index.php?action=index"><i class="fas fa-list"></i> Afficher Réclamations</a>
            <a href="index.php?action=commentaire_add"><i class="fas fa-comment"></i> Ajouter Commentaire</a>
        </div>
    </div>

    <script>
    document.getElementById('reclamationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Réinitialiser les erreurs
        document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
        document.querySelectorAll('.input-field').forEach(el => el.classList.remove('error'));
        
        let isValid = true;
        const nom = document.getElementById('nom').value.trim();
        const email = document.getElementById('email').value.trim();
        const message = document.getElementById('message').value.trim();
        
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
        
        // Validation du message
        if (message === '') {
            document.getElementById('messageError').textContent = 'Le message est requis';
            document.getElementById('message').classList.add('error');
            isValid = false;
        } else if (message.length < 10) {
            document.getElementById('messageError').textContent = 'Le message doit contenir au moins 10 caractères';
            document.getElementById('message').classList.add('error');
            isValid = false;
        }
        
        if (isValid) {
            this.submit();
        }
    });
    </script>
</body>
</html>