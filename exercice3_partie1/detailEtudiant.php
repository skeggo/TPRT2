<?php
include 'db.php';

// Get the student ID from the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute SQL query to fetch student
    $stmt = $conn->prepare("SELECT * FROM student WHERE id = ?");
    $stmt->execute([$id]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$student) {
        echo "Étudiant non trouvé.";
        exit();
    }
} else {
    echo "ID invalide.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail de l'étudiant</title>
</head>
<body>
    <h1>Détails de l'étudiant</h1>
    <p><strong>Nom :</strong> <?= htmlspecialchars($student['name']) ?></p>
    <p><strong>Date de naissance :</strong> <?= $student['birthday'] ?></p>
    <a href="list_students.php">← Retour à la liste</a>
</body>
</html>
