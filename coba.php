<?php
function timeElapsed($timestamp) {
    date_default_timezone_set('Asia/Jakarta'); // Sesuaikan dengan zona waktu kamu
    $time = strtotime($timestamp);
    $diff = time() - $time;

    if ($diff < 60) {
        return $diff . " menit yang lalu";
    } elseif ($diff < 3600) {
        return floor($diff / 60) . " menit yang lalu";
    } elseif ($diff < 86400) {
        return floor($diff / 3600) . " jam yang lalu";
    } else {
        return floor($diff / 86400) . " hari yang lalu";
    }
}

// Contoh penggunaan
$timestamp = "2025-02-26 19:02:25";
echo "Waktu Data: " . $timestamp . "<br>";
echo "Waktu Sekarang: " . date('Y-m-d H:i:s') . "<br>";
echo date_default_timezone_get();
echo timeElapsed($timestamp);

?>
