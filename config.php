

<?php
$host = 'localhost'; // Change if necessary
$db = 'truckmanagment'; // Change to your database name
$user = 'root'; // Change to your database user
$pass = ''; // Change to your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit();
}
?>
