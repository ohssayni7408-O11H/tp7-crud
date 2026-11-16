<?php

require_once "../database/connexion.php";

$sql = "
    SELECT
        books.id,
        books.titre,
        books.prix,
        authors.nom,
        authors.prenom

    FROM books

    JOIN authors
        ON books.auteur_id = authors.id
";

$statement = $pdo->query($sql);

$books = $statement->fetchAll(
    PDO::FETCH_ASSOC
);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Biblio - Livres</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/pages.css">
</head>

<body class="dashboard-page">
    <div class="page-shell">
    <header class="page-topbar"><a class="home-link" href="../index.php">← Accueil</a><span class="page-caption">BIBLIOTHÈQUE / LIVRES</span></header>
    <div class="page-heading"><div><div class="eyebrow">CATALOGUE</div><h1>Liste des livres</h1><p>Consultez et gérez les ouvrages de votre bibliothèque.</p></div><a class="btn btn-primary" href="create.php">
        Ajouter un livre
    </a></div>

    <br><br>

    <div class="content-card"><div class="table-wrap"><table>

        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Prix</th>
                <th>Auteur</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($books as $book) { ?>

                <tr>

                    <td>
                        <?php echo $book["id"]; ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($book["titre"]); ?>
                    </td>

                    <td>
                        <?php echo $book["prix"]; ?> DH
                    </td>

                    <td>
                        <?php
                            echo htmlspecialchars(
                                $book["prenom"] . " " . $book["nom"]
                            );
                        ?>
                    </td>

                    <td>

                        <a href="edit.php?id=<?php echo $book["id"]; ?>">
                            Modifier
                        </a>

                        |

                        <a href="delete.php?id=<?php echo $book["id"]; ?>">
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
