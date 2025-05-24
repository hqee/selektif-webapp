<!DOCTYPE html>
<html lang="en">
<?php require "layout/head.php"; ?>

<body>
    <div id="app">
        <?php require "layout/navbar.php"; ?>
        <div id="main">
            <div class="page-heading">
                <h3>Selamat datang di <b>SELEKTIF - Sistem Seleksi Anggota UKM</b></h3>
            </div>
            <div class="page-content justify-content-center">
                <div class="col-md-10">
                    <div class="card border-light mb-3" style="max-width: 75rem;">
                        <div class="card-body fs-5">
                            <p class="card-text fs-5">
                                Aplikasi ini dirancang untuk membantu panitia dalam melakukan proses seleksi calon anggota UKM secara objektif, efisien, dan transparan menggunakan metode Simple Additive Weighting (SAW).
                                <br><br>
                                Metode SAW bekerja dengan memberikan bobot pada setiap kriteria penilaian, lalu menghitung total skor dari setiap calon berdasarkan nilai pada masing-masing kriteria. Skor tertinggi menunjukkan calon dengan tingkat kecocokan terbaik.
                            </p>
                            <hr>
                            <p class="card-text fs-5">
                                Langkah Penyelesaian Simple Additive Weighting (SAW) adalah sebagai berikut
                                :
                            </p>
                            <ol type="1">
                                <li>Menentukan kriteria-kriteria yang akan dijadikan acuan dalam pengambilan
                                    keputusan, yaitu Ci</i>
                                <li>Menentukan rating kecocokan setiap alternatif pada setiap kriteria (X).
                                </li>
                                <li>Membuat matriks keputusan berdasarkan kriteria(Ci), kemudian melakukan
                                    normalisasi matriks berdasarkan persamaan yang disesuaikan dengan jenis
                                    atribut (atribut keuntungan ataupun atribut biaya) sehingga diperoleh
                                    matriks ternormalisasi R.</li>
                                <li>Hasil akhir diperoleh dari proses perankingan yaitu penjumlahan dari
                                    perkalian matriks ternormalisasi R dengan vektor bobot sehingga
                                    diperoleh nilai terbesar yang dipilih sebagai alternatif terbaik
                                    (Ai)sebagai solusi</li>
                            </ol>
                        </div>
                    </div>
                    <!-- <div class="card">
                            <div class="card-header">
                                <h4>Sistem Pendukung Keputusan Manajer IT Terbaik</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p class="card-text">
                                        Aplikasi ini membantu panitia dalam melakukan seleksi calon anggota UKM secara objektif dan efisien menggunakan metode Simple Additive Weighting (SAW). <br>Metode SAW bekerja dengan memberi skor pada setiap kriteria penilaian,
                                        lalu menghitung total skor untuk menentukan peringkat calon anggota.
                                    </P>
                                    <hr>
                                    <p class="card-text">
                                        Langkah Penyelesaian Simple Additive Weighting (SAW) adalah sebagai berikut
                                        :
                                    </p>
                                    <ol type="1">
                                        <li>Menentukan kriteria-kriteria yang akan dijadikan acuan dalam pengambilan
                                            keputusan, yaitu Ci</i>
                                        <li>Menentukan rating kecocokan setiap alternatif pada setiap kriteria (X).
                                        </li>
                                        <li>Membuat matriks keputusan berdasarkan kriteria(Ci), kemudian melakukan
                                            normalisasi matriks berdasarkan persamaan yang disesuaikan dengan jenis
                                            atribut (atribut keuntungan ataupun atribut biaya) sehingga diperoleh
                                            matriks ternormalisasi R.</li>
                                        <li>Hasil akhir diperoleh dari proses perankingan yaitu penjumlahan dari
                                            perkalian matriks ternormalisasi R dengan vektor bobot sehingga
                                            diperoleh nilai terbesar yang dipilih sebagai alternatif terbaik
                                            (Ai)sebagai solusi</li>
                                    </ol>
                                </div>
                            </div>
                        </div> -->
                </div>
                </section>
            </div>
        </div>
    </div>
    <?php include 'layout/footer.php'; ?>
    <?php include 'layout/js.php'; ?>
</body>

</html>