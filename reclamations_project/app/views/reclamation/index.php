<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Réclamations</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <header>
            <h2>Liste des réclamations</h2>
            <a class="add-link" href="?action=create">
                <i class="fas fa-plus-circle"></i> Ajouter une réclamation
            </a>
        </header>

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
                <?php foreach ($reclamations as $rec) : ?>
                    <tr>
                        <td><?= htmlspecialchars($rec['id']) ?></td>
                        <td><?= htmlspecialchars($rec['nom']) ?></td>
                        <td><?= htmlspecialchars($rec['email']) ?></td>
                        <td><?= htmlspecialchars($rec['message']) ?></td>
                        <td class="actions">
                            <a href="?action=update&id=<?= $rec['id'] ?>">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <a href="?action=delete&id=<?= $rec['id'] ?>" onclick="return confirm('Supprimer cette réclamation ?')">
                                <i class="fas fa-trash-alt"></i> Supprimer
                            </a>
                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>