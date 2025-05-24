<?php
include 'service/conn.php';

$nama = $_POST['nama'];
$nilai = $_POST['nilai'];

// Simpan peserta
mysqli_query($koneksi, "INSERT INTO peserta (nama) VALUES ('$nama')");
$peserta_id = mysqli_insert_id($koneksi);

// Simpan nilai-nilai kriteria
foreach ($nilai as $kriteria_id => $val) {
    mysqli_query($koneksi, "INSERT INTO nilai (peserta_id, kriteria_id, nilai) VALUES ($peserta_id, $kriteria_id, $val)");
}

header("Location: manage-data.php");
exit;
