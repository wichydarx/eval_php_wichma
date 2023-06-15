<?php
include 'header.php';
include 'database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM appartement WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $an) {
        echo '<div class="container d-flex">';
        echo '<div class="row mt-4 mb-4">';
        echo '<div class="col">';
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . strtoupper($an['title']) . '</h5>';
        echo '<p class="card-text">' . $an['description'] . '</p>';

        echo '<div class="d-flex justify-content-between">';
        echo '<p class="card-text badge rounded-pill text-bg-success">' . $an['postal_code'] . '</p>';
        echo '<p class="card-text badge rounded-pill text-bg-info">' . $an['city'] . '</p>';
        echo '<p class="card-text badge rounded-pill text-bg-warning">' . $an['type'] . '</p>';
        echo '</div>';

        if (strlen($an['reservation_message']) > 0) {
            echo '<div class="d-flex justify-content-center">';
            echo '<a href="" class="btn btn-info mx-2 disabled">Réserver</a>';
            echo '<p class="card-text mx-2 pt-2">' . 'cette annonce a déjà été réservée' . '</p>';
            echo '</div>';
        } else {

            echo '<a href="" class="btn btn-primary text-center">Réserver</a>';
        }

        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}
if (isset($_POST['reservation_message'])) {
    $reservation_message = htmlspecialchars(addslashes($_POST['reservation_message']));
    if (!empty($reservation_message)) {
        $query = "UPDATE appartement SET reservation_message = :reservation_message WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':reservation_message', $reservation_message);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>
<div class="container">
    <div class="row ">
        <div class="col-5">
            <h1>Message de réservation :</h1>
            <?php if (strlen($an['reservation_message']) > 0) : ?>
                <p class=""><?php echo $an['reservation_message']; ?></p>
            <?php else : ?>
                <p>Aucune demande de réservation</p>
            <?php endif; ?>
        </div>
        <?php if (strlen($an['reservation_message']) < 0) : ?>
            <form class="col-5" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group mb-3">
                    <textarea class="form-control" name="reservation_message"></textarea>
                    <?php if (empty($reservation_message) && isset($_POST['reservation_message'])) : ?>
                        <p class="text-danger">Veuillez renseigner votre message</p>
                    <?php endif; ?>

                </div>
                <button type="submit" class="btn btn-primary">Faire une demande</button>
            </form>
        <?php endif; ?>
    </div>
</div>