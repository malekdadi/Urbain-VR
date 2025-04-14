<h1>Liste des Commentaires</h1>
<a href="index.php?action=commentaire_create">Ajouter un commentaire</a>
<table>
    <tr>
        <th>ID</th>
        <th>ID Réclamation</th>
        <th>Commentaire</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($commentaires as $commentaire): ?>
        <tr>
            <td><?php echo $commentaire['id']; ?></td>
            <td><?php echo $commentaire['reclamation_id']; ?></td>
            <td><?php echo $commentaire['commentaires']; ?></td>
            <td>
                <a href="index.php?action=commentaire_update&id=<?php echo $commentaire['id']; ?>">Modifier</a>
                <a href="index.php?action=commentaire_delete&id=<?php echo $commentaire['id']; ?>">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
