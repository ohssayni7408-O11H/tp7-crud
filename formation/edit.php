<link rel="stylesheet" href="../style.css">
<?php
require_once "../database/connexion.php";

$id = $_GET["id"] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sql = "UPDATE formation SET titre = :titre, duree = :duree
            WHERE id_formation = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ":titre" => $_POST["titre"],
        ":duree" => $_POST["duree"],
        ":id" => $id
    ]);

    header("Location: index.php");
    exit;
}

$statement = $pdo->prepare("SELECT * FROM formation WHERE id_formation = :id");
$statement->execute([":id" => $id]);
$formation = $statement->fetch(PDO::FETCH_ASSOC);

if (!$formation) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une formation</title>
</head>
<body>
    <a href="index.php">← Retour à la liste</a>
    <h1>Modifier une formation</h1>

    <form method="POST">
        <label>Titre</label><br>
        <input type="text" name="titre" required
               value="<?php echo htmlspecialchars($formation["titre"]); ?>"><br><br>

        <label>Durée (mois)</label><br>
        <input type="number" name="duree" min="1" required
               value="<?php echo $formation["duree"]; ?>"><br><br>

        <button type="submit">Modifier</button>
    </form>
</body>
</html>