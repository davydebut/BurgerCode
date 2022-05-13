<?php
require 'admin/database.php';
include 'partials/header.php';
include 'assets/functions.php';


if (isset($_POST['connection'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $usersinfo = getUsers($email);
    var_dump($usersinfo);
    $hash_password = $usersinfo['pwd'];
    var_dump($hash_password);
    if (!password_verify($password, $hash_password)) {
        echo '<p>Mauvais mot de passe</p>';
    } else {
        session_start();
        $_SESSION['pseudo'] = $usersinfo['pseudo'];
        header('Location: index.php?status=Connect');
    }
}

?>
<h1 class="text-logo"><span class="bi-shop"></span> Connection <span class="bi-shop"></span></h1>
<div class="container admin">
    <div class="row">
        <h1><strong>Connection</strong></h1>
        <br>
        <p>Bienvenu sur mon site, si vous n'êtes pas inscrit, <a href="inscription.php">inscrivez-vous</a></p>
        <form method="post" action="connection.php">
            <table>
                <tr>
                    <td>Email : </td>
                    <td><input type="email" name="email" id="" placeholder="Ex : example@google.com"></td>
                </tr>
                <tr>
                    <td>Mot de passe : </td>
                    <td><input type="password" name="password" id="" placeholder="Ex : *****"></td>
                </tr>
            </table>
            <button name="connection">Connection</button>
        </form>
        <div class="form-actions">
            <a href="../BurgerCode" class="btn btn-primary"><span class="bi-arrow-left"> Retour à l'acceuil</span></a>
        </div>
    </div>