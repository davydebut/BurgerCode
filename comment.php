<?php
require 'admin/database.php';

if (isset($_POST)) {
    $message = htmlspecialchars($_POST['message']);
    