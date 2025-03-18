<?php
// File: payment_status.php

// Impor file koneksi database
require '../apply-static/koneksi.php';

// ID pembayaran (biasanya didapat dari parameter URL atau session)
$payment_id = 1; // Contoh ID pembayaran

// Query untuk mengambil data pembayaran
$stmt = $pdo->prepare('SELECT * FROM payments WHERE id = ?');
$stmt->execute([$payment_id]);
$payment = $stmt->fetch();

if ($payment) {
    // Waktu sekarang
    $current_time = date('Y-m-d H:i:s');

    // Batas waktu pembayaran
    $payment_deadline = $payment['payment_deadline'];

    // Hitung sisa waktu pembayaran
    $time_left = strtotime($payment_deadline) - strtotime($current_time);

    if ($time_left > 0) {
        // Jika masih ada waktu
        $hours_left = floor($time_left / 3600);
        $minutes_left = floor(($time_left % 3600) / 60);
        echo "Sisa waktu pembayaran: $hours_left jam $minutes_left menit.";
    } else {
        // Jika waktu habis
        echo "Batas waktu pembayaran telah habis.";
    }
} else {
    echo "Pembayaran tidak ditemukan.";
}
?>