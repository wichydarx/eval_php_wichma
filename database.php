<?php 
define('DB_DSN', 'mysql:host=localhost;dbname=php_evaluation_wichma');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

try {
    $db = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}