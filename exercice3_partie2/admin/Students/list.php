<?php
// admin/students/list.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../auth/login.php');
    exit();
}

$userRole = $_SESSION['user_role'];

include '../../db.php';
include '../../classes/Student.php';

$studentObj = new Student($pdo);
$students = $studentObj->getAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants</title>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { text-align: center; }
        #studentsTable { width: 100%; border-collapse: collapse; }
    </style>
</head>
<body>
    <h1>Liste des étudiants</h1>
    <table id="studentsTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Date de naissance</th>
                <th>Section</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= $student['id'] ?></td>
                    <td><?= htmlspecialchars($student['name']) ?></td>
                    <td><?= $student['birthday'] ?></td>
                    <td><?= $student['section_name'] ?? '' ?></td>
                    <td>
                        <a href="detailEtudiant.php?id=<?= $student['id'] ?>">Détails</a>
                        <?php if ($userRole === 'admin'): ?>
                            | <a href="edit.php?id=<?= $student['id'] ?>">Modifier</a>
                            | <a href="delete.php?id=<?= $student['id'] ?>">Supprimer</a>
                        <?php else: ?>
                            <span style="color:gray;">(Lecture seule)</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <!-- jQuery & DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Buttons extensions -->
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#studentsTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
    </script>
    
    <p><a href="../../admin/dashboard.php">← Retour au Dashboard</a></p>
</body>
</html>
