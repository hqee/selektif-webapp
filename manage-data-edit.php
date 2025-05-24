<?php
include 'service/conn.php';

$id = $_GET['id'];

// Ambil data peserta
$peserta = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM peserta WHERE id=$id"));

// Ambil semua kriteria
$kriteria = mysqli_query($koneksi, "SELECT * FROM kriteria");

// Ambil nilai-nilai peserta
$nilai_result = mysqli_query($koneksi, "SELECT * FROM nilai WHERE peserta_id=$id");
$nilai = [];
while ($n = mysqli_fetch_assoc($nilai_result)) {
    $nilai[$n['kriteria_id']] = $n['nilai'];
}
?>

<h2>Edit Data Alternatif</h2>
<form method="post" action="manage-data-edit-act.php">
    <input type="hidden" name="id" value="<?= $id ?>">

    <label>Nama Peserta:</label><br>
    <input type="text" name="nama" value="<?= $peserta['nama'] ?>"><br><br>

    <h3>Nilai Kriteria</h3>
    <?php while ($k = mysqli_fetch_assoc($kriteria)) : ?>
        <label><?= $k['nama_kriteria'] ?>:</label><br>
        <input type="number" name="nilai[<?= $k['id'] ?>]" value="<?= $nilai[$k['id']] ?? '' ?>"><br><br>
    <?php endwhile; ?>

    <input type="submit" value="Simpan Perubahan">
</form>