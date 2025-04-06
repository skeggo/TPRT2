<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
</head>
<body>
    <h1>Bienvenue dans l'administration</h1>
    <p><a href="../auth/logout.php">Se déconnecter</a></p>
    <ul>
        <li><a href="students/list.php">Gérer les étudiants</a></li>
  
    </ul>
</body>
</html>
