<?php
require 'database/conn.php';
require 'layout/head.php';
?>

<body>
    <div id="app">
        <?php require 'layout/navbar.php'; ?>
        <div id="main">
            <div class="page-heading">
                <h3>Step 3: Normalisasi Matriks Keputusan</h3>
            </div>

            <div class="page-content justify-content-center">
                <div class="col-md-10">
                    <div class="card border-light mb-3" style="max-width: 75rem;">
                        <div class="card-body fs-5">
                            <p class="card-text">
                                Berikut adalah hasil normalisasi dari matriks keputusan berdasarkan tipe kriteria (Benefit atau Cost).
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
                                            echo "<th>{$k['nama_kriteria']}</th>";
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Ambil semua peserta
                                    $peserta = $koneksi->query("SELECT * FROM peserta");
                                    $peserta_array = [];
                                    while ($p = $peserta->fetch_assoc()) {
                                        $peserta_array[] = $p;
                                    }

                                    // Ambil nilai maksimum dan minimum per kriteria
                                    $max_min = [];
                                    foreach ($kriteria_array as $k) {
                                        $k_id = $k['id'];
                                        $nilai_q = $koneksi->query("SELECT nilai FROM nilai WHERE kriteria_id = '$k_id'");
                                        $nilai_arr = [];

                                        while ($n = $nilai_q->fetch_assoc()) {
                                            $nilai_arr[] = $n['nilai'];
                                        }

                                        $max_min[$k_id] = [
                                            'max' => max($nilai_arr),
                                            'min' => min($nilai_arr),
                                        ];
                                    }

                                    // Tampilkan normalisasi
                                    foreach ($peserta_array as $p) {
                                        echo "<tr>";
                                        echo "<td>{$p['nama']}</td>";

                                        foreach ($kriteria_array as $k) {
                                            $nid = $p['id'];
                                            $kid = $k['id'];
                                            $nilai = $koneksi->query("SELECT nilai FROM nilai WHERE peserta_id = '$nid' AND kriteria_id = '$kid'")->fetch_assoc();
                                            $n = $nilai['nilai'] ?? 0;

                                            if ($k['jenis'] == 'benefit') {
                                                $r = $n / $max_min[$kid]['max'];
                                            } else { // cost
                                                $r = $max_min[$kid]['min'] / $n;
                                            }

                                            echo "<td>" . round($r, 4) . "</td>";
                                        }

                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <!-- Tombol navigasi -->
                            <div class="text-end mt-4">
                                <a href="saw-progress-step2.php" class="btn btn-secondary">Kembali</a>
                                <a href="saw-progress-step4.php" class="btn btn-primary">Selanjutnya</a>
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