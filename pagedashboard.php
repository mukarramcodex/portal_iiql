<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header('Location: index.php');
    exit;
}

require 'includes/db.php';

$stmt = $pdo->query("SELECT * FROM wp_e_submissions ORDER BY id DESC");
$submissions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Submissions Dashboard</title>
    <link rel="stylesheet" href="assets/css/datatables.css">
</head>
<body>
    <h1>Elementor Submissions</h1>
    <table id="submissionTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($submissions as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['message']) ?></td>
                    <td><?= htmlspecialchars($row['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/datatables.js"></script>
    <script>
        $(document).ready(function() {
            $('#submissionTable').DataTable();
        });
    </script>
</body>
</html>
