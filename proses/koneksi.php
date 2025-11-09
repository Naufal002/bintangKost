<?php
$host = "localhost";  // biasanya localhost
$user = "root";       // user phpMyAdmin kamu
$pass = "";           // password phpMyAdmin (kosong kalau default XAMPP)
$db   = "bintangkost"; // nama database kamu

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
