<link rel="stylesheet" href="../style.css">
<?php
require_once "../database/connexion.php";

$id = $_GET["id"] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sql = "UPDATE module
            SET titre = :titre, id_formation = :id_formation
            WHERE id_module = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ":titre" => $_POST["titre"],
        ":id_formation" => $_POST["id_formation"],
        ":id" => $id
    ]);

    header("Location: index.php");
    exit;
}

$statement = $pdo->prepare("SELECT * FROM module WHERE id_module = :id");
$statement->execute([":id" => $id]);
$module = $statement->fetch(PDO::FETCH_ASSOC);

if (!$module) {
    header("Location: index.php");
    exit;
}

$formations = $pdo->query("SELECT * FROM formation")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un module</title>
</head>
<body>
    <a href="index.php">← Retour à la liste</a>
    <h1>Modifier un module</h1>

    <form method="POST">
        <label>Titre</label><br>
        <input type="text" name="titre" required
               value="<?php echo htmlspecialchars($module["titre"]); ?>"><br><br>

        <label>Formation</label><br>
        <select name="id_formation" required>
            <?php foreach ($formations as $f) { ?>
                <option value="<?php echo $f["id_formation"]; ?>"
                    <?php if ($f["id_formation"] == $module["id_formation"]) echo "selected"; ?>>
                    <?php echo htmlspecialchars($f["titre"]); ?>
                </option>
            <?php } ?>
        </select><br><br>

        <button type="submit">Modifier</button>
    </form>
</body>
</html>