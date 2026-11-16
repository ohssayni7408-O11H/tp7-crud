<?php

require_once "../database/connexion.php";

if (
    isset($_POST["nom"])
    && isset($_POST["prenom"])
) {

    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];

    $sql = "
        INSERT INTO authors (nom, prenom)
        VALUES (:nom, :prenom)
    ";

    $statement = $pdo->prepare($sql);

    $statement->execute([
        "nom" => $nom,
        "prenom" => $prenom
    ]);

    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Biblio - Ajouter un auteur</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/pages.css">
</head>

<body>

    <h1>Ajouter un auteur</h1>

    <form method="POST">

        <div>

            <label for="nom">
                Nom :
            </label>

            <input
                type="text"
                id="nom"
                name="nom"
                required
            >

        </div>

        <br>

        <div>

            <label for="prenom">
                Prénom :
            </label>

            <input
                type="text"
                id="prenom"
                name="prenom"
                required
            >

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
