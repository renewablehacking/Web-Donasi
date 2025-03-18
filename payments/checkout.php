<?php
// File: checkout.php

// Impor file koneksi database
require '../apply-static/koneksi.php';

// Data contoh (biasanya data ini didapat dari form atau session)
$user_id = 1; // ID pengguna
$amount = 100000; // Jumlah pembayaran

// Waktu checkout (timestamp sekarang)
$checkout_time = date('Y-m-d H:i:s');

// Hitung batas waktu pembayaran (24 jam setelah checkout)
$payment_deadline = date('Y-m-d H:i:s', strtotime('+24 hours', strtotime($checkout_time)));

// Query untuk menyimpan data pembayaran
$stmt = $pdo->prepare('INSERT INTO payments (user_id, amount, checkout_time, payment_deadline) VALUES (?, ?, ?, ?)');
$stmt->execute([$user_id, $amount, $checkout_time, $payment_deadline]);

echo "Checkout berhasil! Batas waktu pembayaran: $payment_deadline";
?>