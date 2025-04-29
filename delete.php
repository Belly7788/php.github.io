<?php
require_once 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("UPDATE products SET status = 0 WHERE id = :id");
    $stmt->execute(['id' => $id]);
}

header("Location: index.php");
exit();
?>