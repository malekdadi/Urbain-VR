<!-- app/views/reclamations/liste.php -->
<?php
$order = $_GET['order'] ?? 'ASC';
$toggleOrder = ($order === 'ASC') ? 'DESC' : 'ASC';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Réclamations</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f2fdf5;
            color: #333;
            margin: 30px;
        }

        h1 {
            color: #2e7d32;
            text-align: center;
        }

        .btn-tri {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #43a047;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-tri:hover {
            background-color: #388e3c;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 0 15px rgba(0, 128, 0, 0.2);
            background-color: #fff;
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #66bb6a;
            color: white;
        }

        tr:hover {
            background-color: #e8f5e9;
        }

        a {
            color: #2e7d32;
            font-weight: bold;
            text-decoration: none;
            margin: 0 5px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h1>📋 Liste des Réclamations</h1>

<a href="index.php?action=index&order=<?= $toggleOrder ?>" class="btn-tri">
    🔤 Trier par nom </a>
</a>
<a href="index.php?action=download_pdf" class="btn-tri" style="background-color:#2e7d32;">📄 Télécharger PDF</a>
<a href="index.php?action=download_excel" class="btn-tri" style="background-color:#388e3c;">📊 Télécharger Excel</a>
<a href="index.php?action=stats" class="btn-action">📈 Voir les statistiques</a>

<!-- Style -->
<style>
    .btn-action {
        display: inline-block;
        margin: 10px;
        padding: 12px 24px;
        background-color: #388e3c; /* Vert foncé */
        color: white;
        font-size: 16px;
        font-weight: bold;
        border-radius: 8px;
        text-decoration: none;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
    }

    .btn-action:hover {
        background-color: #2e7d32; /* Un peu plus foncé au survol */
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.3);
    }
</style>


<table id="reclamation-table">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Message</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reclamations as $rec): ?>
        <tr>
            <td><?= htmlspecialchars($rec['nom']) ?></td>
            <td><?= htmlspecialchars($rec['email']) ?></td>
            <td><?= htmlspecialchars($rec['message']) ?></td>
            <td>
                <a href="index.php?action=update&id=<?= $rec['id'] ?>">✏️Modifier</a> |
                <a href="index.php?action=delete&id=<?= $rec['id'] ?>" onclick="return confirm('Supprimer ?')">🗑️Supprimer</a> |
                <a href="index.php?action=send_mail&id=<?= $rec['id'] ?>&email=<?= urlencode($rec['email']) ?>&message=<?= urlencode($rec['message']) ?>">📧Envoyer mail</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
