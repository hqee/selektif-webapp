<?php
require 'service/conn.php';

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=hasil_ranking_saw.csv");

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

// Output CSV pakai titik koma sebagai delimiter
$output = fopen("php://output", "w");

// Pakai titik koma sebagai pemisah kolom
function fputcsv_custom($handle, $fields, $delimiter = ';', $enclosure = '"', $escape_char = "\\")
{
    $line = [];
    foreach ($fields as $field) {
        $line[] = $enclosure . str_replace($enclosure, $enclosure . $enclosure, $field) . $enclosure;
    }
    fwrite($handle, implode($delimiter, $line) . "\r\n");
}

fputcsv_custom($output, ['Ranking', 'Nama Peserta', 'Nilai Preferensi']);

$rank = 1;
foreach ($hasil as $row) {
    fputcsv_custom($output, [$rank, $row['nama'], $row['nilai']]);
    $rank++;
}
fclose($output);
exit;
