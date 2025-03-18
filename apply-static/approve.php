<?php
// File: approve.php

// Impor file koneksi database
require 'koneksi.php';

date_default_timezone_set('Asia/Makassar');


// Ambil ID dari form
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $timestamp = date('Y-m-d H:i:s'); // Waktu saat approve dilakukan

    // Query untuk mengubah status_approve menjadi 'Y' dan menyimpan waktu perubahan
    $stmt = $pdo->prepare('UPDATE donasi SET status_approve = "Y", waktu_approve = ? WHERE id = ?');
    $stmt->execute([$timestamp, $id]);

    // Redirect kembali ke halaman monitoring_donasi.php
    header('Location: monitoring_donasi.php');
    exit();
} else {
    echo "ID tidak valid.";
}
?>
