<?php
require 'admin/database.php';
echo '<nav class="navbar">
<ul class="nav nav-pills" role="tablist">';

$db = Database::connect();
$statement = $db->query('SELECT * FROM categories');
$categories = $statement->fetchAll();
foreach ($categories as $category) {
if ($category['id'] == '1') {
echo '<li class="nav-item" role="presentation"><a class="nav-link active" data-bs-toggle="pill" data-bs-target="#tab' . $category['id'] . '" role="tab">' . $category['name'] . '</a></li>';
} else {
echo '<li class="nav-item" role="presentation"><a class="nav-link" data-bs-toggle="pill" data-bs-target="#tab' . $category['id'] . '" role="tab">' . $category['name'] . '</a></li>';
}
}
echo    '</ul>';
?>