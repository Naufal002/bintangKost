<?php
session_start();

// Hapus semua session
session_destroy();

// Redirect ke halaman index dengan pesan logout
header("location:../pages/index.php?pesan=logout");
?>