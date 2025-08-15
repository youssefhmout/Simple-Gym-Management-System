<?php
try {
    $conn = new PDO('mysql:host=localhost;port=3307 ;dbname=sale_de_sport', 'root', '');
} catch (PDOException $e) {
    echo ("Erreur de connexion : " . $e->getMessage());
}
