<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "saw-project";

$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
