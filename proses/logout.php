<?php
// 1. Selalu mulai sesi di paling atas
session_start();

// 2. Hapus semua data variabel di dalam session
// (Ini menghapus $_SESSION['status_login'], $_SESSION['username'], dll)
session_unset();

// 3. Hancurkan session-nya di server
session_destroy();

// 4. Arahkan (redirect) user kembali ke halaman utama
// (Kita asumsikan index.php ada di folder yang sama)
header("Location: ../pages/index.php?pesan=logout");
exit;
?>