<?php
include 'partials/header.php';
include 'assets/functions.php';
include 'partials/logo.php';
require 'admin/database.php';

session_start();
$pseudo = $_SESSION['pseudo'];

echo '<div class="container site">
        <div class="col-md-2 col-lg-2">
            <div class="form-actions mb-3">
                <a href="index.php" class="btn btn-primary" role="button"><span class="bi-arrow-left"> Retour</span></a>
            </div>
        </div>
    </div>';

$post = getPost($_GET['id']);
?>
<div class="container admin site">
    <div class="row">
        <div class="col-md-6">
            <?php echo '<h1>' . $post['name'] . '</h1>'; ?>
            <br>
            <?php echo '<img src="img/' . $post['image'] . '" alt="' . $post['name'] . '" class="img-fluid">'; ?>
            <br>
            <?php echo '<p>' . $post['description'] . '</p>'; ?>
        </div>
        <div class="col-md-6 p-3">
            <h1>Commentaires</h1>
            <br>
            <form method="post" action="comment.php">
                <div class="form-group">
                    <textarea name="comment" id="comment" class="form-control" placeholder="Votre commentaire"></textarea>
                </div>
                <br>
                <!-- <button type="button" name="submit" id="submit" class="btn btn-primary">Envoyer</button> -->
                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Envoyer">
            </form>
            <br>
            <?php
            $post_id = $post['id'];
            $comments = getComments($post_id);
            print_r($post_id);
            if (!empty($comments)) {
                foreach ($comments as $comment) {
                    echo '<div class="comment">
                    <p><strong>' . $pseudo . '</strong> le ' . $comment['date'] . '</p>
                    <p>' . $comment['content'] . '</p>
                     </div>';
                }
            } else {
                echo '<div class="comment">
                <p>Aucun commentaire</p>';
            }
            ?>
        </div>
    </div>
</div>