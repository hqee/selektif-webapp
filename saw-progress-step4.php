<?php
include 'service/conn.php';
require 'layout/head.php';
?>

<body>
    <div id="app">
        <?php require 'layout/navbar.php'; ?>
        <div id="main">
            <div class="page-heading">
                <h3>Step 4: Nilai Preferensi</h3>
            </div>

            <div class="page-content justify-content-center">
                <div class="col-md-10">
                    <div class="card border-light mb-3" style="max-width: 75rem;">
                        <div class="card-body fs-5">
                            <p class="card-text">
                                Pada tahap ini, setiap nilai hasil normalisasi dikalikan dengan bobot kriterianya. Nilai-nilai tersebut dijumlahkan untuk mendapatkan skor akhir (nilai preferensi) masing-masing peserta.
                            </p>

                            <table class="table table-bordered mt-4">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama Peserta</th>
                                        <th>Nilai Preferensi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Ambil data kriteria
                                    $kriteria_q = $koneksi->query("SELECT * FROM kriteria");
                                    $kriteria_array = [];
                                    $max_min = [];

                                    while ($k = $kriteria_q->fetch_assoc()) {
                                        $kriteria_array[] = $k;
                                        $kid = $k['id'];

                                        $nilai_q = $koneksi->query("SELECT nilai FROM nilai WHERE kriteria_id = '$kid'");
                                        $nilai_arr = [];
                                        while ($n = $nilai_q->fetch_assoc()) {
                                            $nilai_arr[] = $n['nilai'];
                                        }

                                        $max_min[$kid] = [
                                            'max' => max($nilai_arr),
                                            'min' => min($nilai_arr)
                                        ];
                                    }

                                    // Ambil peserta
                                    $peserta_q = $koneksi->query("SELECT * FROM peserta");
                                    while ($peserta = $peserta_q->fetch_assoc()) {
                                        $total_preferensi = 0;

                                        foreach ($kriteria_array as $k) {
                                            $kid = $k['id'];
                                            $bobot = $k['bobot'];
                                            $jenis = $k['jenis'];

                                            $nilai_q = $koneksi->query("SELECT nilai FROM nilai WHERE peserta_id = '{$peserta['id']}' AND kriteria_id = '$kid'");
                                            $nilai = $nilai_q->fetch_assoc()['nilai'] ?? 0;

                                            if ($jenis == 'benefit') {
                                                $r = $nilai / $max_min[$kid]['max'];
                                            } else {
                                                $r = $max_min[$kid]['min'] / $nilai;
                                            }

                                            $total_preferensi += $r * $bobot;
                                        }

                                        echo "<tr>";
                                        echo "<td>{$peserta['nama']}</td>";
                                        echo "<td>" . round($total_preferensi, 4) . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="text-end mt-4">
                                <a href="saw-progress-step3.php" class="btn btn-secondary">Kembali</a>
                                <a href="saw-progress-step5.php" class="btn btn-primary">Selanjutnya</a>
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