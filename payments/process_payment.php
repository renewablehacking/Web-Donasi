<?php
// File: process_payment.php

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

    // Cek apakah pembayaran masih dalam batas waktu
    if (strtotime($current_time) <= strtotime($payment_deadline)) {
        echo "Pembayaran berhasil diproses.";
        // Lakukan proses pembayaran di sini (misalnya, update status pembayaran di database)
    } else {
        echo "Pembayaran gagal. Batas waktu pembayaran telah habis.";
    }
} else {
    echo "Pembayaran tidak ditemukan.";
}
?>