<?php
session_start();
require 'apply-static/koneksi.php'; // Koneksi database

date_default_timezone_set('Asia/Makassar');

// **Buat CSRF Token**
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // **Cek CSRF Token**
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF Token tidak valid!");
    }

    // **Ambil Input dengan Trim (Hapus Spasi Depan/Belakang)**
    $donatur = trim($_POST['donatur']);
    $hpwa = trim($_POST['hpwa']);
    $nama_bank = trim($_POST['nama_bank']);
    $jumlah = trim($_POST['totalBayar']);

    // **Cek Input Tidak Boleh Kosong**
    if (empty($donatur) || empty($hpwa) || empty($nama_bank) || empty($jumlah)) {
        die("Semua input harus diisi!");
    }

    // **Cek Nomor HP (Hanya Angka)**
    if (!preg_match('/^[0-9]+$/', $hpwa)) {
        die("Nomor HP tidak valid!");
    }

    // **Validasi Bank yang Diizinkan**
    $allowed_banks = ["Bank Syari'ah Indonesia", "Uang Tunai"];
    if (!in_array($nama_bank, $allowed_banks)) {
        die("Bank tidak valid!");
    }

    // **Waktu dan Status**
    $statusApprove = 'T';
    $waktu_apply = date('Y-m-d H:i:s');
    $payment_deadline = date('Y-m-d H:i:s', strtotime('+24 hours', strtotime($waktu_apply)));

    // **Generate TransactionIdentity Aman**
    $TransactionIdentity = bin2hex(random_bytes(16)); // 32 karakter unik

    try {
        // **Query dengan Binding Parameter**
        $stmt = $pdo->prepare("INSERT INTO donasi 
            (TransactionIdentity, donatur, hpwa, bank, jumlah, waktu_apply, tenggat, status_approve) 
            VALUES (:TransactionIdentity, :donatur, :hpwa, :bank, :jumlah, :waktu_apply, :tenggat, :status_approve)");

        $stmt->execute([
            ':TransactionIdentity' => $TransactionIdentity,
            ':donatur' => $donatur,
            ':hpwa' => $hpwa,
            ':bank' => $nama_bank,
            ':jumlah' => $jumlah,
            ':waktu_apply' => $waktu_apply,
            ':tenggat' => $payment_deadline,
            ':status_approve' => $statusApprove
        ]);

        header("Location: checkout.php?TransactionIdentity=" . urlencode($TransactionIdentity));
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Akses tidak diizinkan!";
}
?>
