<?php
require_once 'SessionManager.php';
$session = new SessionManager();

if (isset($_GET['action']) && $_GET['action'] === 'reset') {
    $session->destroySession();
    
    header("Location: index.php");
    exit;
}


if ($session->get('visited') === null) {
    $session->set('visited', true);
    $session->set('visites', 0);
    $message = "Bienvenue sur notre plateforme !";
} else {
    
    $visites = $session->get('visites') + 1;
    $session->set('visites', $visites);
    $message = "Merci pour votre fidélité, c’est votre {$visites}ᵉ visite.";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Session Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f1f1;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 400px;
            margin: 60px auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #ccc;
            border-radius: 8px;
            text-align: center;
        }
        .container h2 {
            margin-top: 0;
            color: #333;
        }
        .container p {
            margin: 20px 0;
            font-size: 16px;
            color: #555;
        }
        .btn-reset {
            display: inline-block;
            padding: 10px 15px;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border-radius: 5px;
            font-weight: bold;
        }
        .btn-reset:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2><?php echo $message; ?></h2>
    <p>
        
        <a class="btn-reset" href="index.php?action=reset">Réinitialiser la session</a>
    </p>
</div>

</body>
</html>
