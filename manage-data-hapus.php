<?php
include 'service/conn.php';

$id = $_GET['id'];

// Hapus nilai-nilai terlebih dahulu
mysqli_query($koneksi, "DELETE FROM nilai WHERE peserta_id=$id");

// Hapus peserta
mysqli_query($koneksi, "DELETE FROM peserta WHERE id=$id");

header("Location: manage-data.php");
exit;
