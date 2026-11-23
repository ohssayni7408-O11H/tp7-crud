<link rel="stylesheet" href="../style.css">
<?php
require_once "../database/connexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sql = "INSERT INTO etudiant (nom, email, id_formation)
            VALUES (:nom,  :email, :id_formation)";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ":nom" => $_POST["nom"],
        ":email" => $_POST["email"],
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
    <title>Ajouter un étudiant</title>
</head>
<body>
    <a href="index.php">← Retour à la liste</a>
    <h1>Ajouter un étudiant</h1>

    <form method="POST">
        <label>Nom</label><br>
        <input type="text" name="nom" required><br><br>


        <label>Email</label><br>
        <input type="email" name="email" required><br><br>

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