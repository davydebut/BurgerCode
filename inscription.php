<?php
require 'admin/database.php';
include 'partials/header.php';

$isSuccess = false;

/* if (isset($_POST['submit'])) {
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
} */

if (isset($_POST['submit'])) {
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $db = Database::connect();
    if (empty($pseudo) || empty($password) || empty($email)) {
        echo '<p>Veuillez remplir tous les champs</p>';
    } else {
        $query = $db->prepare("INSERT INTO users (pseudo, pwd, mail) VALUES(:pseudo, :pwd, :mail)");
        $query->execute(array(
            "pseudo" => $pseudo,
            "pwd" => $password_hash,
            "mail" => $email
        ));
        $isSuccess = true;
    }
}

?>
<h1 class="text-logo"><span class="bi-shop"></span> Inscription <span class="bi-shop"></span></h1>
<div class="container admin">
    <div class="row">
        <h1><strong>Inscription</strong></h1>
        <br>
        <p>Bienvenu sur mon site, pour en voir plus, inscrivez-vous. Sinon, <a href="connection.php">connectez-vous.</a></p>
        <form method="post" action="inscription.php">
            <table>
                <tr>
                    <td>Pseudo : </td>
                    <td><input type="text" name="pseudo" id="" placeholder="Ex : Nicolas"></td>
                </tr>
                <tr>
                    <td>Email : </td>
                    <td><input type="email" name="email" id="" placeholder="Ex : example@google.com"></td>
                </tr>
                <tr>
                    <td>Mot de passe : </td>
                    <td><input type="password" name="password" id="" placeholder="Ex : *****"></td>
                </tr>
                <!-- <tr>
                        <td>Retaper mot de passe : </td>
                        <td><input type="password" name="password_confirm" id="" placeholder="Ex : *****"></td>
                    </tr> -->
            </table>
            <button name="submit">Inscription</button>
        </form>
    </div>
    <div class="form-actions">
        <a href="index.php" class="btn btn-primary"><span class="bi-arrow-left"> Retour à l'acceuil</span></a>
    </div>
</div>