<?php
include 'header.php';
include 'database.php';

$query = "SELECT * FROM appartement";
$stmt = $db->prepare($query);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo '<div class="container">';
echo '<div class="row mt-4">';
foreach ($results as $an) {
    echo '<div class="col-6 mb-3">';
    echo '<div class="card">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . strtoupper($an['title']) . '</h5>';
    echo '<p class="card-text">' . $an['description'] . '</p>';
    echo '<div class="d-flex justify-content-between">';
    echo '<p class="card-text badge rounded-pill text-bg-success">' . $an['postal_code'] . '</p>';
    echo '<p class="card-text badge rounded-pill text-bg-info">' . $an['city'] . '</p>';
    echo '<p class="card-text badge rounded-pill text-bg-warning">' . $an['type'] . '</p>';
    if (strlen($an['reservation_message']) > 0) {

        echo '<p class="card-text badge rounded-pill text-bg-warning">' .'Reservé '.'</p>';
        
    }
    echo '</div>';

    echo  '<a href="voirannonce.php?id=' . $an['id'] . '" class="btn btn-primary btn-block w-100">Voir plus</a>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
echo '</div>';
echo '</div>';
