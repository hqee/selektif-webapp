<!DOCTYPE html>
<html lang="en">
<?php require "layout/head.php"; ?>

<body>
    <div id="app">
        <?php require "layout/navbar.php"; ?>
        <div id="main">
            <div class="page-heading">
                <h3>Step 1: Bobot Preferensi Kriteria</h3>
            </div>

            <div class="page-content justify-content-center">
                <div class="col-md-10">
                    <div class="card border-light mb-3" style="max-width: 75rem;">
                        <div class="card-body fs-5">
                            <p class="card-text">
                                Tabel berikut menampilkan bobot preferensi yang telah ditentukan untuk setiap kriteria penilaian calon anggota:
                            </p>

                            <table class="table table-bordered mt-4">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kriteria</th>
                                        <th>Bobot</th>
                                        <th>Jenis</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'database/conn.php';
                                    $no = 1;
                                    $q = $koneksi->query("SELECT * FROM kriteria");
                                    while ($d = $q->fetch_assoc()) {
                                        echo "<tr>
                                                <td>{$no}</td>
                                                <td>{$d['nama_kriteria']}</td>
                                                <td>{$d['bobot']}</td>
                                                <td>" . ucfirst($d['jenis']) . "</td>
                                              </tr>";
                                        $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <div class="text-end mt-4">
                                <a href="saw-progress-step2.php" class="btn btn-primary">Selanjutnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'layout/footer.php'; ?>
    <?php include 'layout/js.php'; ?>
</body>

</html>