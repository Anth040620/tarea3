<?php
$dsn = 'mysql:host=localhost;dbname=dblibreria';
$username = 'root';
$password = 'anthony0420';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
