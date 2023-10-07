<?php
// je rentre la variable pour me connecter à la base de donnée
$dsn = "mysql:host=localhost;dbname=oliterie3000";
// instancie une nouvelle element dans la classe PDO qui sert de passerelle entre le serveur et la base de donnée
$db = new PDO($dsn, "root", "");;
// initialise une viarible pour recuperer dans la base de donnée qui executes la declaration SQL,renvoye un jeu de résultats en tant qu'objet PDOStatement
$query = $db->query("SELECT id, marque, nom, taille, photo, prix FROM matelas");

// Récupérer les résultats au format tableau associatif
$matelas = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include './template/header.php' ?>

<div class="container">
    <div class="container warper">
        <?php
        foreach ($matelas as $matela) { ?>
            <div class="matela">
                <ul class="container">
                    <a href="matela.php?id=<?= $matela["id"] ?>">
                        <img src="public/img/matelas/<?= $matela["photo"] ?>.jpg" alt="">
                    </a>
                    <li><?= $matela["marque"] ?></li>
                    <li><?= $matela["nom"] ?></li>
                    <li><?= $matela["taille"] ?></li>
                    <li><?= $matela["prix"] ?></li>
                    <li>
                        <button class="button">modifier</button>
                        <button class="button">supprimer</button>
                    </li>
                </ul>
            </div>
        <?php
        }
        ?>

    </div>
</div>

<?php include './template/footer.php' ?>