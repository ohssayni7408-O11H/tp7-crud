<link rel="stylesheet" href="../style.css">
<?php
require_once "../database/connexion.php";

$sql = "SELECT * FROM formation";

$statement = $pdo->query($sql);
$formations = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Centre - Formations</title>
</head>
<body>
    <a href="../index.php">← Accueil</a>
    <h1>Liste des formations</h1>
    <a href="create.php">Ajouter une formation</a>

    <table border="1" cellpadding="6">
        <thead>
            <tr>
                <th>ID</th><th>Titre</th><th>Durée (mois)</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($formations as $f) { ?>
            <tr>
                <td><?php echo $f["id_formation"]; ?></td>
                <td><?php echo htmlspecialchars($f["titre"]); ?></td>
                <td><?php echo $f["duree"]; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $f["id_formation"]; ?>">Modifier</a>
                    <a href="delete.php?id=<?php echo $f["id_formation"]; ?>">Supprimer</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>