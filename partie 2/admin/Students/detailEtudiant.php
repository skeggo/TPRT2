<?php
// admin/students/detailEtudiant.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../auth/login.php');
    exit();
}
include '../../db.php';
include '../../classes/Student.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $studentObj = new Student($pdo);
    $student = $studentObj->getById($id);
    if (!$student) {
        echo "Étudiant introuvable.";
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
    <title>Détails de l'étudiant</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 40px; }
        .details { border-left: 4px solid #007BFF; padding-left: 20px; margin-top: 50px; }
        .details h2 { margin-bottom: 10px; }
        .details p { font-weight: bold; color: #555; }
        a.back-link { text-decoration: none; color: #007BFF; margin-top: 20px; display: inline-block; }
    </style>
</head>
<body>
    <div class="details">
        <h2><?= htmlspecialchars($student['name']) ?> &gt;</h2>
        <p>Filière: <?= $student['section_name'] ?? 'N/A' ?></p>
        <p>Date de naissance: <?= $student['birthday'] ?></p>
        <!-- Optionally display the student's image -->
        <?php if (!empty($student['image'])): ?>
            <img src="../../uploads/<?= $student['image'] ?>" alt="<?= htmlspecialchars($student['name']) ?>" width="200">
        <?php endif; ?>
    </div>
    <a class="back-link" href="list.php">← Retour à la liste</a>
</body>
</html>
