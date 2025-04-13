<h2>Modifier la Réclamation</h2>
<form method="POST" action="index.php?action=update&id=<?php echo $reclamation['id']; ?>">
    <label for="nom">Nom:</label>
    <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($reclamation['nom']); ?>" required><br><br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($reclamation['email']); ?>" required><br><br>

    <label for="message">Message:</label><br>
    <textarea name="message" id="message" rows="5" required><?php echo htmlspecialchars($reclamation['message']); ?></textarea><br><br>

    <input type="submit" value="Mettre à jour la Réclamation">
</form>

<?php
// Afficher les erreurs de validation, si elles existent.
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p style='color:red;'>$error</p>";
    }
}
?>
