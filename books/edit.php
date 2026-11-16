<?php

require_once "../database/connexion.php";

if (!isset($_GET["id"])) {
    die("ID manquant.");
}

$id = $_GET["id"];

$sql = "
    SELECT * FROM books
    WHERE id = :id
";

$statement = $pdo->prepare($sql);

$statement->execute([
    "id" => $id
]);

$book = $statement->fetch(
    PDO::FETCH_ASSOC
);

if (!$book) {
    die("Livre introuvable.");
}

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
        UPDATE books

        SET
            titre = :titre,
            prix = :prix,
            auteur_id = :auteur_id

        WHERE id = :id
    ";

    $statement = $pdo->prepare($sql);

    $statement->execute([
        "titre" => $titre,
        "prix" => $prix,
        "auteur_id" => $auteurId,
        "id" => $id
    ]);

    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Biblio - Modifier un livre</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/pages.css">
</head>

<body>

    <h1>Modifier un livre</h1>

    <form method="POST">

        <div>

            <label for="titre">
                Titre :
            </label>

            <input
                type="text"
                id="titre"
                name="titre"
                value="<?php echo htmlspecialchars($book["titre"]); ?>"
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
                value="<?php echo $book["prix"]; ?>"
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

                <?php foreach ($authors as $author) { ?>

                    <option
                        value="<?php echo $author["id"]; ?>"

                        <?php
                        if ($author["id"] == $book["auteur_id"]) {
                            echo "selected";
                        }
                        ?>
                    >

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
            Modifier
        </button>

    </form>

    <br>

    <a href="index.php">
        Retour
    </a>

</body>

</html>
