<?php

require_once "../database/connexion.php";

if (!isset($_GET["id"])) {
    die("ID manquant.");
}

$id = $_GET["id"];

$sql = "
    DELETE FROM authors
    WHERE id = :id
";

$statement = $pdo->prepare($sql);

$statement->execute([
    "id" => $id
]);

header("Location: index.php");
exit;