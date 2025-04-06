<?php
// test_repository.php


require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../classes/Repository.php';

$sectionRepo = new Repository($pdo, 'sections', 'id');

// 4.findAll()
$allSections = $sectionRepo->findAll();
echo "<h2>All Sections</h2>";
echo "<pre>" . print_r($allSections, true) . "</pre>";

// 5.create()
$newSectionData = [
    'designation' => 'New Section',
    'description' => 'This is a newly added section via Repository'
];
$newSectionId = $sectionRepo->create($newSectionData);
echo "<p>Created new section with ID: $newSectionId</p>";

// 6.findById()
$createdSection = $sectionRepo->findById($newSectionId);
echo "<h2>Created Section</h2>";
echo "<pre>" . print_r($createdSection, true) . "</pre>";

// 7.delete()
$deleted = $sectionRepo->delete($newSectionId);
if ($deleted) {
    echo "<p>Deleted the section with ID: $newSectionId</p>";
} else {
    echo "<p>Failed to delete section with ID: $newSectionId</p>";
}


$userRepo = new Repository($pdo, 'users', 'id');
$allUsers = $userRepo->findAll();
echo "<h2>All Users</h2>";
echo "<pre>" . print_r($allUsers, true) . "</pre>";
