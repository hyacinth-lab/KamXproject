// db.php
<?php
$host = 'localhost';
$dbname = 'fluxreso_web3';  
$username = 'fluxreso_web3';  
$password = 'd5na1kMapM3R';  

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>