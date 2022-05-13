<?php
require 'admin/database.php';
include 'assets/functions.php';

 if (isset($_POST['submit']) && isset($_POST['comment'])) {
    session_start();
    $user_id = $_SESSION['pseudo'];
    $comment = $_POST['comment'];
    $post_id = $post['id'];
    $_SESSION['message'] = 'Votre commentaire a bien été ajouté';
    var_dump($_SESSION);
    var_dump($post_id);
    var_dump($comment);
    var_dump(addComment($comment, $post_id, $user_id));
    // header('Location: comment.php?id=' . $post_id);
    // exit;
 }
