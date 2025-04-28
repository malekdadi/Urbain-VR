<h2>Modifier le Commentaire</h2>
<form method="POST" action="index.php?action=commentaire_update&id=<?php echo $commentaire['id']; ?>">
    <label for="reclamation_id">ID Réclamation:</label>
    <input type="number" name="reclamation_id" id="reclamation_id" value="<?php echo htmlspecialchars($commentaire['reclamation_id']); ?>" required><br><br>

    <label for="commentaires">Commentaire:</label><br>
    <textarea name="commentaires" id="commentaires" rows="5" required><?php echo htmlspecialchars($commentaire['commentaires']); ?></textarea><br><br>

    <input type="submit" value="Mettre à jour le Commentaire">
</form>

<?php
// Afficher les erreurs de validation, si elles existent.
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p style='color:red;'>$error</p>";
    }
}
?>
