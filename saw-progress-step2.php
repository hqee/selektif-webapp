<?php
require 'service/conn.php';
require 'layout/head.php';
?>

<body>
    <div id="app">
        <?php require 'layout/navbar.php'; ?>
        <div id="main">
            <div class="page-heading">
                <h3>Step 2: Matrik Keputusan</h3>
            </div>

            <div class="page-content justify-content-center">
                <div class="col-md-10">
                    <div class="card border-light mb-3" style="max-width: 75rem;">
                        <div class="card-body fs-5">
                            <p class="card-text">
                                Berikut adalah tabel nilai dari setiap peserta (alternatif) terhadap setiap kriteria yang telah ditentukan. Nilai ini merupakan input awal untuk perhitungan SAW.
                            </p>

                            <table class="table table-bordered mt-4">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama Peserta</th>
                                        <?php
                                        $kriteria = $koneksi->query("SELECT * FROM kriteria");
                                        $kriteria_array = [];
                                        while ($k = $kriteria->fetch_assoc()) {
                                            $kriteria_array[] = $k;
                                            echo "<th  class='text-center'>{$k['nama_kriteria']}</th>";
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $peserta = $koneksi->query("SELECT * FROM peserta");
                                    while ($p = $peserta->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>{$p['nama']}</td>";

                                        foreach ($kriteria_array as $k) {
                                            $nilai = $koneksi->query("SELECT nilai FROM nilai WHERE peserta_id = '{$p['id']}' AND kriteria_id = '{$k['id']}'")->fetch_assoc();
                                            echo "<td  class='text-center'>" . ($nilai['nilai'] ?? '-') . "</td>";
                                        }

                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="text-end mt-4">
                                <a href="saw-progress-step1.php" class="btn btn-secondary">Kembali</a>
                                <a href="saw-progress-step3.php" class="btn btn-primary">Selanjutnya</a>
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