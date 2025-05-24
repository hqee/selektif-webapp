<!DOCTYPE html>
<html lang="en">
<?php require 'layout/head.php'; ?>

<body>
    <?php
    include 'service/conn.php';
    $kriteria = mysqli_query($koneksi, "SELECT * FROM kriteria");
    $peserta = mysqli_query($koneksi, "SELECT * FROM peserta");
    ?>

    <div id="app">
        <?php require "layout/navbar.php"; ?>
        <div id="main">
            <div class="page-heading">
                <h3>Manajemen Data Peserta dan Kriteria</h3>

            </div>
            <div class="page-content justify-content-center">
                <div class="col-md-10">
                    <div class="card border-light mb-3">
                        <div class="card-body fs-5">
                            <p class="card-text">
                                Halaman ini menampilkan data calon anggota beserta nilai mereka pada masing-masing kriteria penilaian. <br>Anda dapat melakukan:
                            </p>
                            <ol type="1">
                                <li>Penambahan data peserta atau kriteria baru</li>
                                <li>Pengeditan nilai atau informasi peserta</li>
                                <li>Penghapusan data jika diperlukan</li>
                            </ol>
                            <p>Pastikan data yang dimasukkan akurat untuk mendapatkan hasil seleksi yang objektif dan valid.</p>

                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama Peserta</th>
                                        <?php while ($k = mysqli_fetch_assoc($kriteria)): ?>
                                            <th class="text-center"><?= $k['nama_kriteria']; ?></th>
                                        <?php endwhile; ?>
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    mysqli_data_seek($kriteria, 0); // Reset pointer
                                    while ($p = mysqli_fetch_assoc($peserta)):
                                    ?>
                                        <tr>
                                            <td><?= $p['nama'] ?></td>
                                            <?php
                                            mysqli_data_seek($kriteria, 0);
                                            while ($k = mysqli_fetch_assoc($kriteria)):
                                                $id_peserta = $p['id'];
                                                $id_kriteria = $k['id'];
                                                $nilai_q = mysqli_query($koneksi, "SELECT nilai FROM nilai WHERE peserta_id=$id_peserta AND kriteria_id=$id_kriteria");
                                                $nilai = mysqli_fetch_assoc($nilai_q);
                                            ?>
                                                <td class="text-center"><?= $nilai ? $nilai['nilai'] : '-' ?></td>
                                            <?php endwhile; ?>
                                            <td class="text-center">
                                                <a href="manage-data-edit.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                                <a href="manage-data-hapus.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                            <div class="mb-3 text-end">
                                <a href="manage-data-tambah.php" class="btn btn-success">+ Tambah Peserta</a>
                            </div>
                        </div>

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