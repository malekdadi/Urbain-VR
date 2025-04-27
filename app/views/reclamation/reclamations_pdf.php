<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #999;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #c8e6c9;
        }
    </style>
</head>
<body>
    <h2>Liste des Réclamations</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reclamations as $rec): ?>
                <tr>
                    <td><?= htmlspecialchars($rec['nom']) ?></td>
                    <td><?= htmlspecialchars($rec['email']) ?></td>
                    <td><?= htmlspecialchars($rec['message']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
