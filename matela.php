<?php

$find = false;
$data = array("nom" => "Recette introuvable");
if (isset($_GET["id"])) {
    // on sait qu'il y a un paramètre id dans l'url
    // MAIS pour autant ça ne garantit pas que l'id de la recette existe réellement
    // Connexion à la base marmiton
    $dsn = "mysql:host=localhost;dbname=oliterie3000";
    $db = new PDO($dsn, "root", "");

    // 1/ On prépare la requête SQL avec un paramètre pour palier à l'injection SQL
    $query = $db->prepare("SELECT * FROM matelas WHERE id = :id");
    // 2/ On donne des valeurs à nos paramètres
    $query->bindParam(":id", $_GET["id"], PDO::PARAM_INT);
    // 3/ On execute notre requête préalablement préparée
    $query->execute();
    $matela = $query->fetch(); // retourne un tableau associatif de la recette concernée ou false si pas de correspondance

    if ($matela) {
        $find = true;

        $data = $matela;
    }
}

include("template/header.php");

?>
<h1><?= $data["nom"] ?></h1>
<?php
if ($find) {
?>
<div class="product_container">
    <div class="img_container">
    <img src="public/img/matelas/<?=$data["photo"] ?>" alt="">
</div>
<div class="text_container">
    <p><?= $data["marque"] ?></p>
    <p><?= $data["nom"] ?></p>
    <p><?= $data["taille"] ?></p>
    <p><?= $data["prix"] ?> €</p>
</div>
</div>
<button class="button">modifier</button>
                        <button class="button">supprimer</button>
<?php
}


include("template/footer.php");
?>