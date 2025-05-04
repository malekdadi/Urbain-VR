<?php
$order = $_GET['order'] ?? 'ASC';
$toggleOrder = ($order === 'ASC') ? 'DESC' : 'ASC';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Réclamations</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #27ae60;
            --primary-hover: #1e8449;
            --secondary-color: #2ecc71;
            --light-green: #e8f5e9;
            --white: #fff;
            --text-color: #2d3436;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f6fa;
            margin: 0;
            padding: 20px;
            color: var(--text-color);
        }

        .container {
            max-width: 1200px;
            margin: auto;
            background: var(--white);
            border-radius: 15px;
            padding: 20px;
            box-shadow: var(--shadow);
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 10px;
        }

        h1::after {
            content: "";
            position: absolute;
            width: 100px;
            height: 4px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .btn-return {
            background-color: var(--primary-color);
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            margin-bottom: 20px;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .btn-return:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }

        .btn-return i {
            margin-right: 8px;
        }

        .btn-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            margin-bottom: 25px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow);
            transition: var(--transition);
            font-size: 15px;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-3px);
        }

        .btn-secondary {
            background-color: var(--secondary-color);
            color: white;
        }

        .btn-secondary:hover {
            background-color: #25a35a;
            transform: translateY(-3px);
        }

        h2 {
            text-align: center;
            font-size: 1.8rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .search-form {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        #nomInput {
            width: 350px;
            padding: 14px 20px;
            border: 2px solid var(--primary-color);
            border-radius: 50px;
            font-size: 16px;
            box-shadow: var(--shadow);
        }

        .search-form button {
            padding: 14px 24px;
            border-radius: 50px;
            border: none;
            color: white;
            background-color: var(--primary-color);
            font-size: 16px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
        }

        .search-form button:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }

        .voice-btn {
            background-color: var(--secondary-color);
        }

        .voice-btn:hover {
            background-color: #25a35a;
        }

        .table-container {
            overflow-x: auto;
            border-radius: 10px;
            box-shadow: var(--shadow);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        th, td {
            padding: 16px;
            text-align: center;
            border-bottom: 1px solid #ecf0f1;
        }

        th {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            font-weight: 600;
        }

        tr:hover {
            background-color: var(--light-green);
        }

        .action-links {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .action-link {
            padding: 8px 16px;
            border-radius: 50px;
            color: white;
            text-decoration: none;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            transition: var(--transition);
        }

        .action-link i {
            margin-right: 6px;
        }

        .edit-link {
            background-color: #16a085;
        }

        .edit-link:hover {
            background-color: #138d75;
            transform: translateY(-2px);
        }

        .delete-link {
            background-color: #c0392b;
        }

        .delete-link:hover {
            background-color: #a93226;
            transform: translateY(-2px);
        }

        .mail-link {
            background-color: #2d98da;
        }

        .mail-link:hover {
            background-color: #2471a3;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .search-form, .btn-group {
                flex-direction: column;
                align-items: stretch;
            }

            #nomInput, .search-form button {
                width: 100%;
            }

            th, td {
                padding: 12px;
            }
        }
    </style>
</head>
<body>
<div class="container">

    <a href="http://localhost/reclamations_project_final/public/" class="btn-return">
        <i class="fas fa-arrow-left"></i> Retour à l'Accueil
    </a>

    <h1>📋 Liste des Réclamations</h1>

    <div class="btn-group">
        <a href="index.php?action=index&order=<?= $toggleOrder ?>" class="btn btn-primary">
            🔀 Trier par nom
        </a>
        <a href="index.php?action=download_pdf" class="btn btn-secondary">
            📄 Télécharger PDF
        </a>
        <a href="index.php?action=download_excel" class="btn btn-secondary">
            📊 Télécharger Excel
        </a>
        <a href="index.php?action=stats" class="btn btn-primary">
            📈 Statistiques
        </a>
    </div>

    <h2>🔍 Recherche Réclamations</h2>

    <form method="GET" action="index.php" class="search-form">
        <input type="hidden" name="action" value="chercher">
        <input type="text" name="nom" id="nomInput" placeholder="Rechercher par nom..." value="<?= htmlspecialchars($_GET['nom'] ?? '') ?>">
        <button type="submit"><i class="fas fa-search"></i> Rechercher</button>
        <button type="button" class="voice-btn" onclick="startDictation()">
            <i class="fas fa-microphone"></i> Vocal
        </button>
    </form>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reclamations as $rec): ?>
                <tr>
                    <td><?= htmlspecialchars($rec['id']) ?></td>
                    <td><?= htmlspecialchars($rec['nom']) ?></td>
                    <td><?= htmlspecialchars($rec['email']) ?></td>
                    <td><?= htmlspecialchars($rec['message']) ?></td>
                    <td>
                        <div class="action-links">
                            <a href="index.php?action=update&id=<?= $rec['id'] ?>" class="action-link edit-link">
                                ✏️ Modifier
                            </a>
                            <a href="index.php?action=delete&id=<?= $rec['id'] ?>" class="action-link delete-link"
                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réclamation ?')">
                                🗑️ Supprimer
                            </a>
                            <a href="index.php?action=send_mail&id=<?= $rec['id'] ?>&email=<?= urlencode($rec['email']) ?>&message=<?= urlencode($rec['message']) ?>" 
                               class="action-link mail-link">
                                📤 Envoyer
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function startDictation() {
    if ('webkitSpeechRecognition' in window) {
        const recognition = new webkitSpeechRecognition();
        recognition.lang = "fr-FR";
        recognition.onresult = function(event) {
            document.getElementById('nomInput').value = event.results[0][0].transcript;
        };
        recognition.start();
    } else {
        alert("Votre navigateur ne supporte pas la reconnaissance vocale.");
    }
}
</script>

</body>
</html>
