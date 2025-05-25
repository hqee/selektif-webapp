<!DOCTYPE html>
<html lang="en">
<?php require 'layout/head.php'; ?>

<body>
    <?php
    include 'service/conn.php';
    require 'layout/navbar.php';

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

    <div id="app">
        <div id="main">
            <div class="page-heading">
                <h3>Edit Data Peserta</h3>
            </div>

            <div class="page-content justify-content-center">
                <div class="col-md-10">
                    <div class="card border-light mb-3 shadow-sm">
                        <div class="card-body">
                            <form method="post" action="manage-data-edit-act.php">
                                <input type="hidden" name="id" value="<?= $id ?>">

                                <div class="mb-3">
                                    <h5 class="mb-3">Nama Peserta</h5>
                                    <input type="text" name="nama" value="<?= $peserta['nama'] ?>" class="form-control" required>
                                </div>

                                <h5 class="mb-3">Nilai Kriteria</h5>
                                <?php while ($k = mysqli_fetch_assoc($kriteria)) : ?>
                                    <div class="mb-3">
                                        <label class="form-label"><?= $k['nama_kriteria'] ?>:</label>
                                        <input type="number" name="nilai[<?= $k['id'] ?>]" value="<?= $nilai[$k['id']] ?? '' ?>" class="form-control" required>
                                    </div>
                                <?php endwhile; ?>

                                <div class="text-end">
                                    <a href="manage-data.php" class="btn btn-secondary me-2">Batal</a>
                                    <input type="submit" value="Simpan Perubahan" class="btn btn-primary px-4">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php require 'layout/footer.php'; ?>
    </div>

    <?php require 'layout/js.php'; ?>
</body>

</html>