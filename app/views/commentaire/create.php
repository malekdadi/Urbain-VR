<h2>Ajouter un Commentaire</h2>
<form method="POST" action="index.php?action=add_commentaire">
    <label for="reclamation_id">ID de la Réclamation:</label>
    <input type="number" name="reclamation_id" id="reclamation_id" required><br><br>

    <label for="commentaires">Commentaire:</label><br>
    <textarea name="commentaires" id="commentaires" rows="5" required></textarea><br><br>

    <input type="submit" value="Ajouter le Commentaire">
    


</form>

<?php
// Afficher les erreurs de validation, si elles existent.
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p style='color:red;'>$error</p>";
    }
}
?>
