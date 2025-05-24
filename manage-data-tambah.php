<!DOCTYPE html>
<html lang="en">
<?php require 'layout/head.php'; ?>

<body>
    <?php
    include 'service/conn.php';
    $kriteria = mysqli_query($koneksi, "SELECT * FROM kriteria");
    ?>

    <div id="app">
        <?php require "layout/navbar.php"; ?>
        <div id="main">
            <div class="page-heading">
                <h3>Tambah Data Peserta</h3>
            </div>

            <div class="page-content justify-content-center">
                <div class="col-md-10">
                    <div class="card border-light mb-3 shadow-sm">
                        <div class="card-body">

                            <form method="post" action="manage-data-tambah-act.php">
                                <div class="mb-3">
                                    <h5 class="mb-3">Nama</h5>
                                    <input type="text" name="nama" class="form-control" required>
                                </div>
                                <br>

                                <h5 class="mb-3">Nilai Kriteria</h5>
                                <?php while ($k = mysqli_fetch_assoc($kriteria)) : ?>
                                    <div class="mb-3">
                                        <label class="form-label"><?= $k['nama_kriteria'] ?>:</label>
                                        <input type="number" name="nilai[<?= $k['id'] ?>]" class="form-control" required>
                                    </div>
                                <?php endwhile; ?>

                                <div class="text-end">
                                    <a href="manage-data.php" class="btn btn-secondary me-2">Batal</a>
                                    <input type="submit" value="Simpan" class="btn btn-primary px-4">
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