<?php

$find = false;
$data = array("nom" => "Recette introuvable");
if (isset($_GET["id"])) {

    $dsn = "mysql:host=localhost;dbname=oliterie3000";
    $db = new PDO($dsn, "root", "");


    $query = $db->prepare("SELECT * FROM matelas WHERE id = :id");
 
    $query->bindParam(":id", $_GET["id"], PDO::PARAM_INT);

    $query->execute();
    $matela = $query->fetch(); 

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
<button class="delete-btn"><a href="supprimer_produit.php?id=<?= $matela['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">Supprimer</a></button> 
<?php
}


include("template/footer.php");
?>