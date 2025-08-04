<?php
require_once 'includes/auth.php';
require_once 'includes/db.php';

// Get Filterls
$name = $_GET['name'] ?? '';
$email = $_GET['email'] ?? '';
$date = $_GET['date'] ?? '';

// build SQL query with filters
$query = "SELECT * FROM inquiries WHERE 1=1";
$params = [];

if ($name) {
    $query .= " AND name LIKE  ? ";
    $params[] = "%$name";
}

if ($email) {
    $query .= " AND email LIKE ? ";
    $params[] = "%$email";
}

if ($date) {
    $query .= " AND DATE(created_at) = ?";
    $params[] = $date;
}

$query .= " ORDER BY created_at DESC";
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$inquiries = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | IIQL Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard-container">
    <h2>Submissions From Website</h2>

    <form action="" method="get" class="filter-form">
        <input type="text" name="name" placeholder="NAME" value="<?= htmlspecialchars($name) ?>">
        <input type="text" name="email" placeholder="EMAIL" value="<?= htmlspecialchars($email) ?>">
        <input type="date" name="date" placeholder="DATE" value="<?= htmlspecialchars($date) ?>">
        <button type="submit">FILTER</button>
        <a href="dashboard.php">Reset</a>
    </form>
    
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
                <?php if (count($inquiries)): ?>
            <?php foreach ($inquiries as $inquiry): ?>
                    <tr>
                        <td><?= $inquiry['id'] ?></td>
                        <td><?= htmlspecialchars($inquiry['name']) ?></td>
                        <td><?= htmlspecialchars($inquiry['email']) ?></td>
                        <td><?= nl2br(htmlspecialchars($inquiry['message'])) ?></td>
                        <td><?= htmlspecialchars($inquiry['status']) ?></td>
                        <td><?= $inquiry['created_at'] ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr><td colspan="6">No Inquiries Found.</td></tr>
            <?php  endif; ?>
        </tbody>
    </table>
    
    <p><a href="logout.php">Logout</a></p>
    </div>    
</body>
</html>