<?php
include 'database/conn.php';

$kriteria = mysqli_query($koneksi, "SELECT * FROM kriteria");
?>

<h2>Tambah Data Alternatif</h2>
<form method="post" action="manage-data-tambah-act.php">
    <label>Nama Peserta:</label><br>
    <input type="text" name="nama" required><br><br>

    <h3>Nilai Kriteria</h3>
    <?php while ($k = mysqli_fetch_assoc($kriteria)) : ?>
        <label><?= $k['nama_kriteria'] ?>:</label><br>
        <input type="number" name="nilai[<?= $k['id'] ?>]" required><br><br>
    <?php endwhile; ?>

    <input type="submit" value="Simpan">
</form>