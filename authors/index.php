<?php

require_once "../database/connexion.php";

$sql = "SELECT * FROM authors";

$statement = $pdo->query($sql);

$authors = $statement->fetchAll(
    PDO::FETCH_ASSOC
);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Biblio - Auteurs</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/pages.css">
</head>

<body class="dashboard-page">
    <div class="page-shell">
    <header class="page-topbar"><a class="home-link" href="../index.php">← Accueil</a><span class="page-caption">BIBLIOTHÈQUE / AUTEURS</span></header>
    <div class="page-heading"><div><div class="eyebrow">RÉPERTOIRE</div><h1>Liste des auteurs</h1><p>Consultez et gérez les auteurs de votre bibliothèque.</p></div><a class="btn btn-primary" href="create.php">
        Ajouter un auteur
    </a></div>

    <br><br>

    <div class="content-card"><div class="table-wrap"><table>

        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($authors as $author) { ?>

                <tr>

                    <td>
                        <?php echo $author["id"]; ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($author["nom"]); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($author["prenom"]); ?>
                    </td>

                    <td>

                        <a href="edit.php?id=<?php echo $author["id"]; ?>">
                            Modifier
                        </a>

                        |

                        <a href="delete.php?id=<?php echo $author["id"]; ?>">
                            Supprimer
                        </a>

                    </td>

                </tr>

            <?php } ?>

        </tbody>

    </table></div></div>

    </div>

</body>

</html>
