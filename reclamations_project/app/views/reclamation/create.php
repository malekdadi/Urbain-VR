<h2>Ajouter une Réclamation</h2>
    <form method="POST" action="index.php?action=create">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" id="nom" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="message">Message:</label><br>
        <textarea name="message" id="message" rows="5" required></textarea><br><br>

        <input type="submit" value="Soumettre la Réclamation">
    </form>


<?php
// Afficher les erreurs de validation, si elles existent.
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p style='color:red;'>$error</p>";
    }
}
?>
