<?php

// fonction pour afficher un post par id
function getPost($id)
{
    $db = Database::connect();
    $statement = $db->prepare('SELECT * FROM items WHERE id = ?');
    $statement->execute(array($id));
    $item = $statement->fetch();
    return $item;
}
// fonction pour afficher les commentaires d'un post
function getComments($id)
{
    $db = Database::connect();
    $statement = $db->prepare('SELECT * FROM comments WHERE item_id = ?');
    $statement->execute(array($id));
    $comments = $statement->fetchAll();
    return $comments;
}
// fonction pour ajouter un commentaire
function addComment($item_id, $author_id, $content)
{
    $db = Database::connect();
    $statement = $db->prepare('INSERT INTO comments (item_id, author_id, content) VALUES (?, ?, ?)');
    $statement->execute(array($item_id, $author_id, $content));
}


$connect = false;
if (isset($_POST['connection'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $db = Database::connect();
    $statement = $db->prepare('SELECT * FROM users WHERE mail = ? AND password = ?');
    $statement->execute(array($email, $password));
    $user = $statement->fetch();
    if (!password_verify($password, $user['pwd'])) {
        echo '<p>Mauvais mot de passe</p>';
    } else {
        session_start();
        $_SESSION['pseudo'] = $user['pseudo'];
        header('Location: index.php?vous_etes_connecte');
        $connect = true;
    }
}
