<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $dsn = "mysql:host=localhost;dbname=oliterie3000";
    $db = new PDO($dsn, "root", "");

    $query = $db->prepare("DELETE FROM matelas WHERE id = :id");
    $query->bindParam(":id", $id, PDO::PARAM_INT);

    if ($query->execute()) {
        // Rediriger vers la page d'accueil ou une page de confirmation de suppression
        header("Location: index.php");
        exit();
    } else {
        echo "Erreur lors de la suppression du produit.";
    }
}
?>
