<?php
require 'database.php';

if (!empty($_GET['id'])) {
    $id = checkInput($_GET['id']);
}

$nameError = $descriptionError = $priceError = $categoryError = $imageError = $name = $description = $price = $category = $image = "";

if (!empty($_POST)) {
    $name = checkInput($_POST['name']);
    $description = checkInput($_POST['description']);
    $price = checkInput($_POST['price']);
    $category = checkInput($_POST['category']);
    $image = checkInput($_FILES['image']['name']);
    $imagePath = '../img/' . basename($image);
    $imageExt = pathinfo($imagePath, PATHINFO_EXTENSION);
    $isSuccess = true;

    if (empty($name)) {
        $nameError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    if (empty($description)) {
        $descriptionError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    if (empty($price)) {
        $priceError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    if (empty($category)) {
        $categoryError = 'Ce champ ne peut pas être vide';
        $isSuccess = false;
    }
    if (empty($image)) {
        $imageUpdated = false;
    } else {
        $imageUpdated = true;
        $isUploadSuccess = true;
        if ($imageExt != "jpg" && $imageExt != "png" && $imageExt != "jpeg" && $imageExt != "gif") {
            $imageError = "Les fichiers autorises sont : .jpg .jpeg .png .gif";
            $isUploadSuccess = false;
        }
        if (file_exists($imagePath)) {
            $imageError = "Le fichier existe deja";
            $isUploadSuccess = false;
        }
        if ($_FILES["image"]["size"] > 500000) {
            $imageError = "Le fichier ne doit pas depasser les 500KB";
            $isSuccess = false;
        }
        if ($isUploadSuccess) {
            // il va prendre le chemin temporaire de l'image et le mettre dans le chemin de la variable $imagePath qui contient le dossier img
            if (!move_uploaded_file($_FILES['image']["tmp_name"], $imagePath)) {
                $imageError = "Il y a eu une erreur lors de l'upload";
                $isUploadSuccess = false;
            }
        }
    }
    if (($isSuccess && $isImageUpdated && $isUploadSuccess) || ($isSuccess && !$isImageUpdated)) {
        $db = Database::connect();
        if ($isImageUpdated) {
            $statement = $db->prepare("UPDATE items set name = ?, description = ?, price = ?, category = ?, image = ? WHERE id = ?");
            $statement->execute(array($name, $description, $price, $category, $image, $id));
        } else {
            $statement = $db->prepare("UPDATE items set name = ?, description = ?, price = ?, category = ? WHERE id = ?");
            $statement->execute(array($name, $description, $price, $category, $id));
        }
        Database::disconnect();
        header("Location: index.php");
    } elseif ($imageUpdated && !$isUploadSuccess) {
        // reinitialise l'image avec l'image de base
        $db = Database::connect();
        $statement = $db->prepare("SELECT image FROM items WHERE id = ?");
        $statement->execute(array($id));
        $item = $statement->fetch();
        $image = $item['image'];
        Database::disconnect();
    }
} else {
    $db = Database::connect();
    $statement = $db->prepare("SELECT * FROM items WHERE id = ?");
    $statement->execute(array($id));
    $item = $statement->fetch();
    $name = $item['name'];
    $description = $item['description'];
    $price = $item['price'];
    $category = $item['category'];
    $image = $item['image'];
    Database::disconnect();
}

function checkInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Burger Code</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <h1 class="text-logo"><span class="bi-shop"></span> Burger Code <span class="bi-shop"></span></h1>
    <div class="container admin">
        <div class="row">
            <div class="col-sm-6">
                <h1><strong>Modifier un item</strong></h1>
                <br>
                <form class="form" role="form" action="<?php echo 'update.php?id=' . $id; ?>" method="POST" enctype="multipart/form-data">
                    <div>
                        <label class="form-label" for="name">Nom :</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name; ?>">
                        <span class="help-inline"><?php echo $nameError; ?></span>
                    </div>
                    <div>
                        <label class="form-label" for="description">Description :</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description; ?>">
                        <span class="help-inline"><?php echo $descriptionError; ?></span>
                    </div>
                    <div>
                        <label class="form-label" for="price">Prix : (en €)</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Prix" value="<?php echo $price; ?>">
                        <span class="help-inline"><?php echo $priceError; ?></span>
                    </div>
                    <div>
                        <label class="form-label" for="category">Categorie :</label>
                        <select class="form-control" name="category" id="category">
                            <?php
                            $db = Database::connect();
                            foreach ($db->query('SELECT * FROM categories') as $row) {
                                if ($row['id'] == $category) {

                                    echo '<option selected="selected" value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                } else {
                                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                }
                            }
                            Database::disconnect();

                            ?>

                        </select>
                        <span class="help-inline"><?php echo $categoryError; ?></span>
                    </div>
                    <div>
                        <label>Image:</label>
                        <p><?php echo $image; ?></p>
                        <label class="form-label" for="image">Séléctionner une image :</label>
                        <input type="file" name="image" id="image">
                        <span class="help-inline"><?php echo $imageError; ?></span>
                    </div>
                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><span class="bi bi-pencil-fill"></span> Modifier</button>
                        <a href="index.php" class="btn btn-primary"><span class="bi-arrow-left"> Retour</span></a>
                    </div>
                </form>
            </div>
            <div class="col-sm-6 site">
                <div class="img-thumbnail">
                    <img src="<?php echo '../img/' . $image; ?>" alt="...">
                    <div class="price"><?php echo number_format($price, 2, '.', '') . ' €'; ?></div>
                    <div class="caption">
                        <h4><?php echo $name; ?></h4>
                        <p><?php echo $description; ?></p>
                        <a href="#" class="btn btn-order" role="button"><span class="bi-cart"></span> Commander</a>
                    </div>
                </div>
            </div>
</body>

</html>