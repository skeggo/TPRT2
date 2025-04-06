<?php
// auth/login.php
session_start();
include '../db.php';
include '../classes/User.php';

$userObj = new User($pdo);
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $user = $userObj->authenticate($username, $password);
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['role'];
        header('Location: ../admin/dashboard.php');
        exit();
    } else {
        $error = "Identifiants invalides";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
    <h1>Se connecter</h1>
    <?php if ($error): ?>
      <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <div>
            <label>Nom d'utilisateur:</label>
            <input type="text" name="username" required>
        </div>
        <div>
            <label>Mot de passe:</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Connexion</button>
    </form>
</body>
</html>
