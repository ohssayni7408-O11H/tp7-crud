<?php
require_once "../database/connexion.php";

$id = $_GET["id"] ?? null;

if ($id) {
    $statement = $pdo->prepare("DELETE FROM etudiant WHERE id_etudiant = :id");
    $statement->execute([":id" => $id]);
}

header("Location: index.php");
exit;