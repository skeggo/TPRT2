<?php
$servername = "127.0.0.1"; 
$username = "root";
$password = "";             
$port = 3307;               
$dbname = "student_db";     

try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>
