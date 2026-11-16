<?php

require_once "../database/connexion.php";

$sql = "SELECT * FROM authors";

$statement = $pdo->query($sql);

$authors = $statement->fetchAll(
    PDO::FETCH_ASSOC
);

if (
    isset($_POST["titre"])
    && isset($_POST["prix"])
    && isset($_POST["auteur_id"])
) {

    $titre = $_POST["titre"];
    $prix = $_POST["prix"];
    $auteurId = $_POST["auteur_id"];

    $sql = "
        INSERT INTO books (
            titre,
            prix,
            auteur_id
        )

        VALUES (
            :titre,
            :prix,
            :auteur_id
        )
    ";

    $statement = $pdo->prepare($sql);

    $statement->execute([
        "titre" => $titre,
        "prix" => $prix,
        "auteur_id" => $auteurId
    ]);

    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Biblio - Ajouter un livre</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/pages.css">
</head>

<body>

    <h1>Ajouter un livre</h1>

    <form method="POST">

        <div>

            <label for="titre">
                Titre :
            </label>

            <input
                type="text"
                id="titre"
                name="titre"
                required
            >

        </div>

        <br>

        <div>

            <label for="prix">
                Prix :
            </label>

            <input
                type="number"
                step="0.01"
                id="prix"
                name="prix"
                required
            >

        </div>

        <br>

        <div>

            <label for="auteur_id">
                Auteur :
            </label>

            <select
                id="auteur_id"
                name="auteur_id"
                required
            >

                <option value="">
                    Choisir un auteur
                </option>

                <?php foreach ($authors as $author) { ?>

                    <option value="<?php echo $author["id"]; ?>">

                        <?php
                            echo htmlspecialchars(
                                $author["prenom"]
                                . " "
                                . $author["nom"]
                            );
                        ?>

                    </option>

                <?php } ?>

            </select>

        </div>

        <br>

        <button type="submit">
            Ajouter
        </button>

    </form>

    <br>

    <a href="index.php">
        Retour
    </a>

</body>

</html>
