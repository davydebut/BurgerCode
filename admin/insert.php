<?php
require 'database.php';
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
            <h1><strong>Ajouter un item</strong></h1>
            <br>
            <form class="form" role="form" action="insert.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Nom :</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name; ?>">
                    <span class="help-inline"><?php echo $nameError; ?></span>
                </div>
                <div class="form-group">
                    <label for="description">Description :</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description; ?>">
                    <span class="help-inline"><?php echo $descriptionError; ?></span>
                </div>
                <div class="form-group">
                    <label for="price">Prix : (en €)</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Prix" value="<?php echo $price; ?>">
                    <span class="help-inline"><?php echo $priceError; ?></span>
                </div>
                <div class="form-group">
                    <label for="category">Categorie :</label>
                    <select class="form-control" name="category" id="category">
                        <?php
                        $db = Database::connect();
                        foreach ($db->query('SELECT * FROM categories') as $row) {
                            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                        }
                        Database::disconnect();

                        ?>

                    </select>
                    <span class="help-inline"><?php echo $categoryError; ?></span>
                </div>
                <div class="form-group">
                    <label for="image">Séléctionner une image :</label>
                    <input type="file" name="image" id="image">
                    <span class="help-inline"><?php echo $imageError; ?></span>
                </div>
            </form>
            <br>
            <div class="form-actions">
                <button type="submit" class="btn btn-success"><span class="bi bi-pencil-fill"></span> Ajouter</button>
                <a href="index.php" class="btn btn-primary"><span class="bi-arrow-left"> Retour</span></a>
            </div>
        </div>
    </div>
</body>

</html>