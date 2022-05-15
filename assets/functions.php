<?php

// fonction pour afficher un post par id
function getPost($id)
{
    $db = Database::connect();
    $statement = $db->prepare('SELECT * FROM items WHERE id = ?');
    $statement->execute(array($id));
    $item = $statement->fetch(PDO::FETCH_ASSOC);
    return $item;
}
// fonction pour afficher les commentaires d'un post
// faire une jointure pour le name
function getComments($id)
{
    $db = Database::connect();
    $statement = $db->prepare('SELECT * FROM comments INNER JOIN items ON comments.item_id = items.id WHERE comments.item_id = ?');
    $statement->execute();
    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $comments;
}
// fonction pour ajouter un commentaire
function addComment($comment, $post_id, $user_id){
    $db = Database::connect();
    $statement = $db->prepare('INSERT INTO comments (content, item_id, user_id) VALUES (?, ?, ?)');
    $statement->execute(array($comment, $post_id, $user_id));

}
// La différence entre query prepare et exec depend de ce que va préparer la requete
// envoyer le pwd_hash
function addUsers($pseudo, $email, $pwd){
    $db = Database::connect();
    $statement = $db->prepare("INSERT INTO users VALUES (NULL, :pseudo, :pwd, :mail)");
    $statement->bindParam(':pseudo',$pseudo);
    $statement->bindParam(':mail',$email);
    $statement->bindParam(':pwd',$pwd);
    $statement->execute();
}

function getUsers($email){
    $db = Database::connect();
    $statement = $db->query("SELECT * FROM users WHERE users.mail = '$email'");
    $user = $statement->fetch();
    return $user;
}