<?php

require_once 'Etudiant.php';

$etudiant1 = new Etudiant("Aymen", [11, 13, 18, 7, 10, 13, 2, 5, 1]);
$etudiant2 = new Etudiant("Skander", [15, 9, 8, 16]);
$etudiant3 = new Etudiant("Seif", [14, 15, 12, 7, 10, 13, 2, 5, 1]);

$etudiants = [$etudiant1, $etudiant2, $etudiant3];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exercice Étudiants</title>
    <link rel="stylesheet" href="style.css">    
    <?php include 'sessionPage.php'; ?>
</head>
<body>

<h1>Liste des étudiants</h1>

<div class="containerEtudiants">
    <?php foreach ($etudiants as $etudiant): ?>
        <div class="etudiant">
            <div class="nom"><?php echo $etudiant->getNom(); ?></div>
            <?php 
                $notes = $etudiant->afficherNotes();
                foreach ($notes as $note) {
                    if ($note < 10) {
                        $class = "note rouge";
                    } elseif ($note > 10) {
                        $class = "note vert";
                    } else {
                        $class = "note orange";
                    }
                    echo "<div class='{$class}'>{$note}</div>";
                }
            ?>
            <div class="infos">Moyenne : <?php echo number_format($etudiant->calculerMoyenne(), 2); ?></div>
            <div class="infos"><?php echo $etudiant->estAdmis() ? "Admis" : "Non Admis"; ?></div>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>