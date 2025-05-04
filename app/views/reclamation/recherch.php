<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>🔍 Recherche Réclamations</title>
    <style>
        /* Style général avec thème vert */
        body {
            font-family: 'Montserrat', 'Segoe UI', sans-serif;
            line-height: 1.6;
            color: #2d3436;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background: #f5f9f5;
            min-height: 100vh;
        }

        /* Titre principal vert */
        .page-title {
            text-align: center;
            color: #27ae60;
            font-size: 2.5rem;
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 15px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.05);
        }

        .page-title:after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, #2ecc71, #27ae60);
            border-radius: 2px;
        }

        /* Tableau avec thème vert */
        .reclamation-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 30px 0;
            font-size: 0.95em;
            box-shadow: 0 10px 30px rgba(46, 204, 113, 0.1);
            border-radius: 12px;
            overflow: hidden;
            background: white;
        }

        .reclamation-table thead tr {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
            text-align: left;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .reclamation-table th {
            padding: 16px 20px;
            position: relative;
        }

        .reclamation-table th:not(:last-child):after {
            content: "";
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 60%;
            width: 1px;
            background: rgba(255,255,255,0.3);
        }

        .reclamation-table td {
            padding: 14px 20px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .reclamation-table tbody tr {
            transition: all 0.3s ease;
        }

        .reclamation-table tbody tr:nth-of-type(even) {
            background-color: rgba(46, 204, 113, 0.03);
        }

        .reclamation-table tbody tr:last-child td {
            border-bottom: none;
        }

        .reclamation-table tbody tr:hover {
            background-color: rgba(46, 204, 113, 0.1);
            transform: translateX(5px);
        }

        /* Message "Aucune réclamation" vert */
        .no-results {
            text-align: center;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(46, 204, 113, 0.1);
            color: #636e72;
            font-size: 1.2em;
            margin: 30px 0;
            border-left: 4px solid #e74c3c;
        }

        .no-results i {
            color: #e74c3c;
            font-size: 1.5em;
            margin-bottom: 10px;
            display: block;
        }

        /* Badge de résultats vert */
        .results-count {
            display: inline-block;
            background: #27ae60;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.9em;
            margin-left: 10px;
            vertical-align: middle;
        }

        /* Style responsive */
        @media screen and (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }
            
            .reclamation-table {
                font-size: 0.85em;
            }
            
            .reclamation-table th, 
            .reclamation-table td {
                padding: 12px 15px;
            }
        }

        @media screen and (max-width: 480px) {
            .page-title {
                font-size: 1.8rem;
            }
            
            .reclamation-table {
                display: block;
                overflow-x: auto;
                border-radius: 8px;
            }
            
            .no-results {
                padding: 20px;
                font-size: 1em;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .reclamation-table {
            animation: fadeIn 0.6s ease-out;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <h1 class="page-title">Résultats de Recherche 
        <?php if(isset($reclamations) && !empty($reclamations)): ?>
            <span class="results-count"><?= count($reclamations) ?> résultat(s)</span>
        <?php endif; ?>
    </h1>

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

    <?php
    if (isset($_GET['nom'])) {
        $searchNom = $_GET['nom'];
        $reclamations = $this->reclamationModel->rechercherReclamations($searchNom);

        if (empty($reclamations)) {
            echo '<div class="no-results">
                    <i class="fas fa-search-minus"></i>
                    Aucune réclamation trouvée pour votre recherche.
                  </div>';
        } else {
            echo '<table class="reclamation-table">';
            echo '<thead><tr><th>ID</th><th>Nom</th><th>E-mail</th><th>Message</th></tr></thead>';
            echo '<tbody>';
            foreach ($reclamations as $rec) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($rec['id']) . '</td>';
                echo '<td>' . htmlspecialchars($rec['nom']) . '</td>';
                echo '<td>' . htmlspecialchars($rec['email']) . '</td>';
                echo '<td>' . htmlspecialchars($rec['message']) . '</td>';
                echo '</tr>';
            }
            echo '</tbody></table>';
        }
    }
    ?>
</body>
</html>