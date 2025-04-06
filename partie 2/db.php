<?php
// db.php
$host    = '127.0.0.1';
$dbname  = 'student_management';
$user    = 'root';
$pass    = '';         
$port    = 3307;       

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
