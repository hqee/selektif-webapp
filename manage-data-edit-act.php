<?php
include 'database/conn.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$nilai = $_POST['nilai'];

// Update nama peserta
mysqli_query($koneksi, "UPDATE peserta SET nama='$nama' WHERE id=$id");

// Update nilai-nilai
foreach ($nilai as $kriteria_id => $val) {
    // Cek apakah nilai sudah ada
    $cek = mysqli_query($koneksi, "SELECT * FROM nilai WHERE peserta_id=$id AND kriteria_id=$kriteria_id");
    if (mysqli_num_rows($cek) > 0) {
        mysqli_query($koneksi, "UPDATE nilai SET nilai=$val WHERE peserta_id=$id AND kriteria_id=$kriteria_id");
    } else {
        mysqli_query($koneksi, "INSERT INTO nilai (peserta_id, kriteria_id, nilai) VALUES ($id, $kriteria_id, $val)");
    }
}

header("Location: manage-data.php");
exit;
