<link rel="stylesheet" href="../style.css">
<?php
require_once "../database/connexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titre = $_POST["titre"];
    $duree = $_POST["duree"];

    $sql = "INSERT INTO formation (titre, duree) VALUES (:titre, :duree)";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ":titre" => $titre,
        ":duree" => $duree
    ]);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une formation</title>
</head>
<body>
    <a href="index.php">← Retour à la liste</a>
    <h1>Ajouter une formation</h1>

    <form method="POST">
        <label>Titre</label><br>
        <input type="text" name="titre" required><br><br>

        <label>Durée (mois)</label><br>
        <input type="number" name="duree" min="1" required><br><br>

        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>