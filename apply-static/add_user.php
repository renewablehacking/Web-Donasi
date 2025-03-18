<?php
// File: add_user.php
require 'koneksi.php';

// Data pengguna baru
$username = 'konbrut';
$password = 'tobrut'; // Password yang akan dienkripsi

// Enkripsi password menggunakan SHA1
$hashedPassword = sha1($password);

// Query untuk menambahkan pengguna
$stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
$stmt->execute([$username, $hashedPassword]);

echo "User added successfully!";
?>