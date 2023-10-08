<?php
if (!empty($_POST)) {
    
    $nom = trim(strip_tags($_POST["nom"]));
    $marque = trim(strip_tags($_POST["marque"]));
    $taille = trim(strip_tags($_POST["taille"]));
    $prix = trim(strip_tags($_POST["prix"]));
    $errors = [];
    var_dump($error);
  
    if (empty($nom)) {
        $errors["nom"] = "Le nom du matelas est obligatoire";
    }

    if (isset($_FILES["picture"]) && $_FILES["picture"]["error"] === UPLOAD_ERR_OK) {
        
        $fileTmpPath = $_FILES["picture"]["tmp_name"];
        $fileName = $_FILES["picture"]["name"];
        $fileType = $_FILES["picture"]["type"];

        $fileNameArray = explode(".", $fileName);
        $fileExtension = end($fileNameArray);
        $newFileName = md5($fileName . time()) . "." . $fileExtension;

        // Attention à vérifier que le dossier de destination est bien créé au préalable
        $fileDestPath = "./public/img/matelas/{$newFileName}";

        $allowedTypes = array("image/jpeg");
        if (in_array($fileType, $allowedTypes)) {
            // Le type de fichier est bien valide on peut donc ajouter le fichier à notre serveur
            move_uploaded_file($fileTmpPath, $fileDestPath);
        } else {
            // Le type de fichier est incorrect
            $errors["picture"] = "Le type de fichier est incorrect (.jpg requis)";
        }
    }

   
    if (empty($errors)) {
        $dsn = "mysql:host=localhost;dbname=oliterie3000";
        $db = new PDO($dsn, "root", "");

        $query = $db->prepare("INSERT INTO matelas (marque, nom, taille, photo, prix) VALUES (:marque, :nom, :taille, :photo, :prix)");
        $query->bindParam(":marque", $marque);
        $query->bindParam(":nom", $nom);
        $query->bindParam(":taille", $taille);
        $query->bindParam(":photo", $newFileName);
        $query->bindParam(":prix", $prix);

        if ($query->execute()) {
           
            header("Location: index.php");
        }
    }
}

include("template/header.php");
?>
<h1>Ajouter un matelas</h1>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="inputNom">Nom du matelas :</label>
        <input type="text" id="inputNom" name="nom" value="<?= isset($nom) ? $nom : "" ?>">
        <?php
        if (isset($errors["nom"])) {
        ?>
            <span class="info-error"><?= $errors["nom"] ?></span>
        <?php
        }
        ?>
    </div>
    <div class="form-group">
        <label for="inputPhoto">Photo du matelas :</label>
        <input type="file" id="inputPhoto" name="picture">
        <?php
        if (isset($errors["picture"])) {
        ?>
            <span class="info-error"><?= $errors["picture"] ?></span>
        <?php
        }
        ?>
    </div>
    <div class="form-group">
        <label for="selectMarque">Choisissez une marque :</label>
        <select name="marque" id="selectMarque">
            <option value="epeda" <?= isset($marque) && $marque === "epeda" ? "selected" : "" ?>>Epeda</option>
            <option value="dreamway" <?= isset($marque) && $marque === "dreamway" ? "selected" : "" ?>>Dreamway</option>
            <option value="bultex" <?= isset($marque) && $marque === "bultex" ? "selected" : "" ?>>Bultex</option>
            <option value="Dorsoline" <?= isset($marque) && $marque === "Dorsoline" ? "selected" : "" ?>>Dorsoline</option>
            <option value="MemoryLine" <?= isset($marque) && $marque === "MemoryLine" ? "selected" : "" ?>>MemoryLine</option>
        </select>
    </div>
    
    <div class="form-group">
        
    <label for="inputPrix">Prix du matelas :</label>
        
    <input type="number" name="prix" id="inputPrix" value="<?= isset($prix) ? $prix : 0 ?>">
        
        <?php
        if (isset($errors["prix"])) {
        ?>
            <span class="info-error"><?= $errors["prix"] ?></span>
        <?php
        }
        ?>
    </div>
    <div class="form-group">
        <label for="selectTaille">Choisissez une taille de matelas:</label>
        <select name="taille" id="selectTaille">
            <option value="90x190" <?= isset($taille) && $taille === "90x190" ? "selected" : "" ?>>90x190</option>
            <option value="140x190" <?= isset($taille) && $taille === "140x190" ? "selected" : "" ?>>140x190</option>
            <option value="160x200" <?= isset($taille) && $taille === "160x200" ? "selected" : "" ?>>160x200</option>
            <option value="180x200" <?= isset($taille) && $taille === "180x200" ? "selected" : "" ?>>180x200</option>
            <option value="200x200" <?= isset($taille) && $taille === "200x200" ? "selected" : "" ?>>200x200</option>
        </select>
    </div>

    <input type="submit" value="Ajouter le matelas" class="btn-matelas">
    <input type="submit" value="Revenir" class="btn-matelas" href="./index.php">
</form>
<?php
include("template/footer.php");
?>