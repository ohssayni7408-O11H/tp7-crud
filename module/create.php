<link rel="stylesheet" href="../style.css">
<?php
require_once "../database/connexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sql = "INSERT INTO module (titre, id_formation)
            VALUES (:titre,:id_formation)";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ":titre" => $_POST["titre"],
        ":id_formation" => $_POST["id_formation"]
    ]);

    header("Location: index.php");
    exit;
}

$formations = $pdo->query("SELECT * FROM formation")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un module</title>
</head>
<body>
    <a href="index.php">← Retour à la liste</a>
    <h1>Ajouter un module</h1>

    <form method="POST">
        <label>Titre</label><br>
        <input type="text" name="titre" required><br><br>

       
        <label>Formation</label><br>
        <select name="id_formation" required>
            <option value="">-- Choisir --</option>
            <?php foreach ($formations as $f) { ?>
                <option value="<?php echo $f["id_formation"]; ?>">
                    <?php echo htmlspecialchars($f["titre"]); ?>
                </option>
            <?php } ?>
        </select><br><br>

        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>