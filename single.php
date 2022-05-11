<?php
include 'partials/header.php';
include 'assets/functions.php';
include 'partials/logo.php';

echo '<div class="container site">
        <div class="col-md-2 col-lg-2">
            <div class="form-actions mb-3">
                <a href="index.php" class="btn btn-primary" role="button"><span class="bi-arrow-left"> Retour</span></a>
            </div>
        </div>
    </div>';
// img/' . $item['image'] . '" class="img-fluid" alt="..."
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
        <div class="col-md-6">
            <h1>Commentaires</h1>
            <br>
            <form method="post">
                <div class="form-group">
                    <textarea name="comment" id="comment" class="form-control" placeholder="Votre commentaire"></textarea>
                </div>
                <br>
                <button type="submit" id="submit" class="btn btn-primary">Envoyer</button>
            </form>
            <br>
            <?php
            $comments = getComments($_GET['id']);
            if (!empty($comments)) {
                foreach ($comments as $comment) {
                    echo '<div class="comment">
                    <p><strong>' . $comment['name'] . '</strong> le ' . $comment['date'] . '</p>
                    <p>' . $comment['comment'] . '</p>
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