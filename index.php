<?php
include 'header.php';
include 'database.php';

$query = "SELECT * FROM appartement";
$stmt = $db->prepare($query);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<div class="container">';
echo '<div class="row">';

foreach ($results as $an) {
    echo '<div class="col-md-4">';
    echo '<div class="card">';
    echo '<div class="card-body">';
    echo'<a href="voirannonce.php?id=' . $an['id'] . '">';
    echo '<h5 class="card-title">' . strtoupper($an['title']) . '</h5>';
    echo '</a>';
    echo '<p class="card-text">' . $an['postal_code'] . '</p>';
    echo '<p class="card-text">' . $an['city'] . '</p>';
    echo '<p class="card-text">' . $an['type'] . '</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

echo '</div>';
echo '</div>';
