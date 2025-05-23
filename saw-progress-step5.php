<?php
require 'database/conn.php';
require 'layout/head.php';
?>

<body>
    <div id="app">
        <?php require 'layout/navbar.php'; ?>
        <div id="main">
            <div class="page-heading">
                <h3>Step 5: Skor Akhir dan Ranking</h3>
            </div>

            <div class="page-content justify-content-center">
                <div class="col-md-10">
                    <div class="card border-light mb-3" style="max-width: 75rem;">
                        <div class="card-body fs-6">
                            <p class="card-text">
                                Berikut adalah hasil akhir dari proses metode SAW, berupa skor total (nilai preferensi) dan peringkat tiap peserta.
                            </p>

                            <table class="table table-bordered mt-4">
                                <thead class="table-light">
                                    <tr>
                                        <th>Ranking</th>
                                        <th>Nama Peserta</th>
                                        <th>Nilai Preferensi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
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

                                    // Hitung nilai preferensi
                                    $peserta_q = $koneksi->query("SELECT * FROM peserta");
                                    $hasil = [];

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

                                        $hasil[] = [
                                            'nama' => $peserta['nama'],
                                            'nilai' => round($total_preferensi, 4)
                                        ];
                                    }

                                    // Urutkan berdasarkan nilai preferensi tertinggi
                                    usort($hasil, function ($a, $b) {
                                        return $b['nilai'] <=> $a['nilai'];
                                    });

                                    $rank = 1;
                                    foreach ($hasil as $row) {
                                        echo "<tr>";
                                        echo "<td>{$rank}</td>";
                                        echo "<td>{$row['nama']}</td>";
                                        echo "<td>{$row['nilai']}</td>";
                                        echo "</tr>";
                                        $rank++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="text-end mt-4">
                                <a href="saw-progress-step4.php" class="btn btn-secondary">Kembali</a>
                                <a href="login.php" class="btn btn-success">Selesai</a>
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