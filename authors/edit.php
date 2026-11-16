<?php

require_once "../database/connexion.php";

if (!isset($_GET["id"])) {
    die("ID manquant.");
}

$id = $_GET["id"];

$sql = "
    SELECT * FROM authors
    WHERE id = :id
";

$statement = $pdo->prepare($sql);

$statement->execute([
    "id" => $id
]);

$author = $statement->fetch(
    PDO::FETCH_ASSOC
);

if (!$author) {
    die("Auteur introuvable.");
}

if (
    isset($_POST["nom"])
    && isset($_POST["prenom"])
) {

    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];

    $sql = "
        UPDATE authors
        SET
            nom = :nom,
            prenom = :prenom
        WHERE id = :id
    ";

    $statement = $pdo->prepare($sql);

    $statement->execute([
        "nom" => $nom,
        "prenom" => $prenom,
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
    <title>Biblio - Modifier un auteur</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/pages.css">
</head>

<body>

    <h1>Modifier un auteur</h1>

    <form method="POST">

        <div>

            <label for="nom">
                Nom :
            </label>

            <input
                type="text"
                id="nom"
                name="nom"
                value="<?php echo htmlspecialchars($author["nom"]); ?>"
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
                value="<?php echo htmlspecialchars($author["prenom"]); ?>"
                required
            >

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
