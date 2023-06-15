<?php
include 'header.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = htmlspecialchars(addslashes($value));
    }
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $code_postal = $_POST['code_postal'];
    $ville = $_POST['ville'];
    $type = $_POST['type'];
    $prix = $_POST['prix'];


    $errors = [];

    if (empty($titre)) {
        $errors['titre'] = "Le champ 'Titre de l'annonce' est obligatoire.";
    }

    if (empty($description)) {
        $errors['desc'] = "Le champ 'Description de l'annonce' est obligatoire.";
    }

    if (empty($code_postal)) {
        $errors['cp'] = "Le champ 'Code postal' est obligatoire.";
    } elseif (!is_numeric($code_postal)) {
        $errors['cp'] = "Le champ 'Code postal' doit être numérique.";
    } elseif (strlen($code_postal) != 5) {
        $errors['cp'] = "Le champ 'Code postal' doit avoir 5 chiffres.";
    }

    if (empty($ville)) {
        $errors['ville'] = "Le champ 'Ville' est obligatoire.";
    }

    if (empty($type)) {
        $errors['type'] = "Le champ 'Type d'annonce' est obligatoire.";
    }

    if (empty($prix)) {
        $errors['prix'] = "Le champ 'Prix' est obligatoire.";
    }


    if (empty($errors)) {
        include 'database.php';
        try {
            $sql = "INSERT INTO appartement (title, description, postal_code, city, type, price) VALUES (:titre, :description, :code_postal, :ville, :type, :prix)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':titre', $titre);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':code_postal', $code_postal);
            $stmt->bindParam(':ville', $ville);
            $stmt->bindParam(':type', $type);
            $stmt->bindParam(':prix', $prix);
            $stmt->execute();
            if ($stmt) {
                echo "<div class='alert alert-success' role='alert'>Annonce ajoutée avec succès.</div>";
            }
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
?>
<div class="container">
    <h1 class="mt-5">Ajouter une annonce</h1>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group mb-3">
            <label class="form-label" for="titre">Titre de l'annonce:</label>
            <input type="text" class="form-control" id="titre" name="titre" value="<?php echo isset($_POST['titre']) ? $_POST['titre'] : ''; ?>">
            <span class="text-danger"><?php echo isset($errors['titre']) ? $errors['titre'] : ''; ?></span>
        </div>

        <div class="form-group mb-3">
            <label class="form-label" for="description">Description de l'annonce:</label>
            <textarea class="form-control" id="description" name="description" rows="4"><?php echo isset($_POST['description']) ? $_POST['description'] : ''; ?></textarea>
            <span class="text-danger"><?php echo isset($errors['desc']) ? $errors['desc'] : ''; ?></span>
        </div>

        <div class="form-group row mb-3">
            <div class="form-group col-md-6">
                <label class="form-label" for="code_postal">Code postal:</label>
                <input type="text" class="form-control" id="code_postal" name="code_postal" value="<?php echo isset($_POST['code_postal']) ? $_POST['code_postal'] : ''; ?>">
                <span class="text-danger"><?php echo isset($errors['cp']) ? $errors['cp'] : ''; ?></span>
            </div>

            <div class="form-group col-md-6">
                <label class="form-label" for="ville">Ville:</label>
                <input type="text" class="form-control" id="ville" name="ville" value="<?php echo isset($_POST['ville']) ? $_POST['ville'] : ''; ?>">
                <span class="text-danger"><?php echo isset($errors['ville']) ? $errors['ville'] : ''; ?></span>
            </div>
        </div>

        <div class="form-group mb-3">
            <label class="form-label" for="type">Type d'annonce:</label>
            <select class="form-control" id="type" name="type">
                <option value="location" <?php echo isset($_POST['type']) && $_POST['type'] == 'location' ? 'selected' : ''; ?>>Location</option>
                <option value="vente" <?php echo isset($_POST['type']) && $_POST['type'] == 'vente' ? 'selected' : ''; ?>>Vente</option>
            </select>
            <span class="text-danger"><?php echo isset($errors['type']) ? $errors['type'] : ''; ?></span>
        </div>

        <div class="form-group mb-3">
            <label class="form-label" for="prix">Prix:</label>
            <input type="number" class="form-control" id="prix" name="prix" value="<?php echo isset($_POST['prix']) ? $_POST['prix'] : ''; ?>">
            <span class="text-danger"><?php echo isset($errors['prix']) ? $errors['prix'] : ''; ?></span>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>