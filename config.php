<?php
$conn = new mysqli('localhost', 'root', '', 'ecommerce_db');
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}
?>
