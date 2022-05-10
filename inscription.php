<?php
require 'admin/database.php';
include 'partials/header.php';

if (isset($_POST['submit'])) {
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password = htmlspecialchars($_POST['password']);
    $password_clean = password_hash($password, PASSWORD_BCRYPT);
    $db = Database::connect();
    if (empty($pseudo) || empty($password) || empty($email)) {
        echo '<p>Veuillez remplir tous les champs</p>';
    } else {
        $prepare = $db->prepare("SELECT COUNT(*) AS nbre FROM users WHERE pseudo = :pseudo AND pwd = :password");
        $prepare->execute(['pseudo' => $pseudo, 'pwd' => $password]);
        $result = $prepare->fetch(PDO::FETCH_ASSOC);
        // si le pseudo n'existe pas
        if ($result['nbre'] == 0) {
            $email = htmlspecialchars($_POST['email']);
            $isSuccess = true;
            $prepare = $db->prepare("INSERT INTO users (pseudo, pwd, mail) VALUES (:pseudo, :password, :email)");
            $prepare->execute([
                'pseudo' => $pseudo,
                'password' => $password_clean,
                'email' => $email
            ]);
            // si le pseudo existe déjà
        } else {
            // echo '<p>Ce pseudo est déjà utilisé</p>';
            $connect = true;
            $_SESSION['pseudo'] = $pseudo;
        }
    }
}
?>
<h1 class="text-logo"><span class="bi-shop"></span> Inscription <span class="bi-shop"></span></h1>
<div class="container admin">
        <div class="row">
            <h1><strong>Inscription</strong></h1>
            <br>
            <form class="form" role="form" action="inscription.php" method="POST" enctype="multipart/form-data">
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
                            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                        }
                        Database::disconnect();

                        ?>

                    </select>
                    <span class="help-inline"><?php echo $categoryError; ?></span>
                </div>
                <div>
                    <label class="form-label" for="image">Séléctionner une image :</label>
                    <input type="file" name="image" id="image">
                    <span class="help-inline"><?php echo $imageError; ?></span>
                </div>
                <br>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success"><span class="bi bi-pencil-fill"></span> Ajouter</button>
                    <a href="index.php" class="btn btn-primary"><span class="bi-arrow-left"> Retour</span></a>
                </div>
            </form>
        </div>
    </div>