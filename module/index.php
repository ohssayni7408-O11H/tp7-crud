<link rel="stylesheet" href="../style.css">
<?php
require_once "../database/connexion.php";

$sql = "SELECT m.id_module, m.titre, f.titre AS formation
        FROM module m
        JOIN formation f ON m.id_formation = f.id_formation";

$statement = $pdo->query($sql);
$modules = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Centre - Modules</title>
</head>
<body>
    <a href="../index.php">← Accueil</a>
    <h1>Liste des modules</h1>
    <a href="create.php">Ajouter un module</a>

    <table border="1" cellpadding="6">
        <thead>
            <tr>
                <th>ID</th><th>Titre</th>
                <th>Formation</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($modules as $m) { ?>
            <tr>
                <td><?php echo $m["id_module"]; ?></td>
                <td><?php echo htmlspecialchars($m["titre"]); ?></td>
                <td><?php echo htmlspecialchars($m["formation"]); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $m["id_module"]; ?>">Modifier</a>
                    <a href="delete.php?id=<?php echo $m["id_module"]; ?>">Supprimer</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>