<?php
require_once "../database/connexion.php";

$id = $_GET["id"] ?? null;

if ($id) {
    try {
        $statement = $pdo->prepare("DELETE FROM formation WHERE id_formation = :id");
        $statement->execute([":id" => $id]);
    } catch (PDOException $e) {
        die("Impossible de supprimer cette formation : elle contient encore des étudiants ou des modules.
             <br><a href='index.php'>← Retour à la liste</a>");
    }
}

header("Location: index.php");
exit;