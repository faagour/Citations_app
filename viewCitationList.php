<?php
// Dummy data for citations
$citations = [
    [
        'id' => 1,
        'login' => 'user123',
        'author' => 'Jane Doe',
        'quote_date' => '2024-02-28',
        'registration_date' => '2024-02-01'
    ],
    [
        'id' => 2,
        'login' => 'user456',
        'author' => 'John Smith',
        'quote_date' => '2024-02-27',
        'registration_date' => '2024-01-20'
    ],
    // ... add more dummy citations as needed
];

//http://localhost:8888/CitationSysteme/viewCitationList.php
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Citation List</title>
    <!-- Add any other meta/link tags required for styling or responsiveness -->
    <style>
    <?php include 'style.css'; ?>
    </style>
</head>
<body>
    <h1><?php echo basename($_SERVER['PHP_SELF']); ?></h1>
    <table>
        <thead>
            <tr>
                <th>Login</th>
                <th>Auteur</th>
                <th>Date de citation</th>
                <th>Date d'enregistrement</th>
                <th>Lire</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($citations as $citation): ?>
                <tr>
                    <td><?= htmlspecialchars($citation['login']) ?></td>
                    <td><?= htmlspecialchars($citation['author']) ?></td>
                    <td><?= htmlspecialchars($citation['quote_date']) ?></td>
                    <td><?= htmlspecialchars($citation['registration_date']) ?></td>
                    <td><a href="viewOneCitation.php?id=<?= urlencode($citation['id']) ?>">Lire</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
