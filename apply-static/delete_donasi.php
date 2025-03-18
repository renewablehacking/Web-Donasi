<?php 

require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil ID dari request
    $id = $_POST['id'];

    // Query untuk menghapus data
    $sql = "DELETE FROM donasi WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: monitoring_donasi.php');
    } else {
        echo "ID tidak valid.";
    }
}

?>