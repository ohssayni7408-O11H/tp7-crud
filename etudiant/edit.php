<link rel="stylesheet" href="../style.css">
<?php
require_once "../database/connexion.php";

$id = $_GET["id"] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sql = "UPDATE etudiant
            SET nom = :nom, email = :email, id_formation = :id_formation
            WHERE id_etudiant = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ":nom" => $_POST["nom"],
        ":email" => $_POST["email"],
        ":id_formation" => $_POST["id_formation"],
        ":id" => $id
    ]);

    header("Location: index.php");
    exit;
}

$statement = $pdo->prepare("SELECT * FROM etudiant WHERE id_etudiant = :id");
$statement->execute([":id" => $id]);
$etudiant = $statement->fetch(PDO::FETCH_ASSOC);

if (!$etudiant) {
    header("Location: index.php");
    exit;
}

$formations = $pdo->query("SELECT * FROM formation")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un étudiant</title>
</head>
<body>
    <a href="index.php">← Retour à la liste</a>
    <h1>Modifier un étudiant</h1>

    <form method="POST">
        <label>Nom</label><br>
        <input type="text" name="nom" required
               value="<?php echo htmlspecialchars($etudiant["nom"]); ?>"><br><br>

       
        <label>Email</label><br>
        <input type="email" name="email" required
               value="<?php echo htmlspecialchars($etudiant["email"]); ?>"><br><br>

        <label>Formation</label><br>
        <select name="id_formation" required>
            <?php foreach ($formations as $f) { ?>
                <option value="<?php echo $f["id_formation"]; ?>"
                    <?php if ($f["id_formation"] == $etudiant["id_formation"]) echo "selected"; ?>>
                    <?php echo htmlspecialchars($f["titre"]); ?>
                </option>
            <?php } ?>
        </select><br><br>

        <button type="submit">Modifier</button>
    </form>
</body>
</html>