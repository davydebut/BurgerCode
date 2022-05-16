<?php
require 'admin/database.php';
include 'assets/functions.php';
// include 'single.php';
session_start();
// var_dump($_SESSION);
$post_id = $_SESSION['id'];
$post_id = (int) $post_id;
$_GET['id'] = $post_id;
// var_dump($post_id);
// print_r($post_id);

if (isset($_POST['submit']) && isset($_POST['comment'])) {
   $user_id = $_SESSION['id'];
   $comment = $_POST['comment'];
   $post_id = $_GET['id'];
   $_SESSION['message'] = 'success';
   addComment($comment, $post_id, $user_id);
   header('Location: single.php?id='.$post_id.'&message='.$_SESSION['message']);
   exit;
}
