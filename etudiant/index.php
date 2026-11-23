<link rel="stylesheet" href="../style.css">
<?php
require_once "../database/connexion.php";

$sql = "SELECT e.id_etudiant, e.nom, e.email, f.titre AS formation
        FROM etudiant e
        JOIN formation f ON e.id_formation = f.id_formation";

$statement = $pdo->query($sql);
$etudiants = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Centre - Étudiants</title>
</head>
<body>
    <a href="../index.php">← Accueil</a>
    <h1>Liste des étudiants</h1>
    <a href="create.php">Ajouter un étudiant</a>

    <table border="1" cellpadding="6">
        <thead>
            <tr>
                <th>ID</th><th>Nom</th>
                <th>Email</th><th>Formation</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($etudiants as $e) { ?>
            <tr>
                <td><?php echo $e["id_etudiant"]; ?></td>
                <td><?php echo htmlspecialchars($e["nom"]); ?></td>
                <td><?php echo htmlspecialchars($e["email"]); ?></td>
                <td><?php echo htmlspecialchars($e["formation"]); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $e["id_etudiant"]; ?>">Modifier</a>
                    <a href="delete.php?id=<?php echo $e["id_etudiant"]; ?>">Supprimer</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>