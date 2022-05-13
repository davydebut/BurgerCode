<?php
require 'admin/database.php';
include 'partials/header.php';
include 'assets/functions.php';

if (!empty($_POST)) {
    // 1 - je prepare mes données
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email =  htmlspecialchars($_POST['email']);
    $pwd =  htmlspecialchars($_POST['password']);
    $pwd_hash = password_hash($pwd, PASSWORD_BCRYPT);
    // 2 - envoie les données ecrit sur functions.php
    // 3 - lance la fonction
    addUsers($pseudo, $email, $pwd_hash);
    header('Location: index.php?status=Success');
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
            </table>
            <button name="submit">Inscription</button>
        </form>
    </div>
    <div class="form-actions">
        <a href="index.php" class="btn btn-primary"><span class="bi-arrow-left"> Retour à l'acceuil</span></a>
    </div>
</div>

