<?php
include 'db.php';

$sql = "SELECT * FROM student";
$stmt = $conn->prepare($sql);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des étudiants</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Liste des étudiants</h1>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Date de naissance</th>
        </tr>
        <?php foreach($students as $student): ?>
            <tr>
        <td><?= $student['id'] ?></td>
        <td><?= htmlspecialchars($student['name']) ?></td>
        <td><?= $student['birthday'] ?></td>
        <td>
            <!-- Link to details page -->
            <a href="detailEtudiant.php?id=<?= $student['id'] ?>">
                <img src="https://cdn-icons-png.flaticon.com/512/84/84380.png" alt="details" width="20">
            </a>
        </td>
    </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
