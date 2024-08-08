<?php

include_once './includes/api.php';
include_once './includes/fpdf/fpdf.php';

// Fungsi untuk mengambil dan mengatur data berdasarkan periode
function getDataForPDF($periode)
{
    global $koneksi; // Gunakan variabel koneksi yang sudah didefinisikan

    $data = array();

    // Query untuk mendapatkan data histori berdasarkan periode
    $sql = "SELECT * FROM laporan_alternatif WHERE periode = :periode";
    $stmt = $koneksi->prepare($sql);
    $stmt->bindParam(':periode', $periode);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Ambil nama alternatif berdasarkan id alternatif yang ada di tabel histori
    foreach ($data as $key => $value) {
        $id_alternatif = $value['alternatif'];
        $sql = "SELECT * FROM alternatif WHERE id = :id";
        $stmt = $koneksi->prepare($sql);
        $stmt->bindParam(':id', $id_alternatif);
        $stmt->execute();
        $data[$key]['alternatif'] = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Urutkan data berdasarkan hasil akhir dari yang terbesar ke terkecil
    usort($data, function ($a, $b) {
        if ($a['hasil_akhir'] == $b['hasil_akhir']) {
            return 0;
        }
        return ($a['hasil_akhir'] > $b['hasil_akhir']) ? -1 : 1;
    });

    // Berikan peringkat berdasarkan urutan hasil akhir
    $peringkat = 1;
    foreach ($data as $key => $value) {
        $data[$key]['peringkat'] = $peringkat;
        $peringkat++;
    }

    return $data;
}

// Fungsi untuk membuat file PDF
function createPDF($data)
{
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);



    //buat header laporan 
    $pdf->Image('images/puskesmas.png', 26, 10, 33.70);
    $pdf->Cell(0, 10, 'PEMERINTAH KOTA KUPANG', 0, 1, 'C');
    $pdf->Cell(0, 10, 'DINAS KESEHATAN KOTA KUPANG', 0, 1, 'C');
    $pdf->Cell(0, 10, 'UPTD PUSKESMAS OESAPA', 0, 1, 'C');

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 10, 'Jl. Suratim RT 15 / RW 06, Kel. Oesapa, Kec. Kelapa Lima,Kota Kupang', 0, 1, 'C');
    //buat garis pembatas 
    $pdf->Line(10, 48, 200, 48);

    // Judul PDF
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'Laporan Evaluatif Kinerja Nakes', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Periode ' . $_GET['periode'], 0, 1, 'C');
    $pdf->Ln(10);



    // Header tabel
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(22, 7, 'Peringkat', 1, 0, 'C');
    $pdf->Cell(80, 7, 'Nama', 1, 0, 'C');
    $pdf->Cell(43, 7, 'Jabatan', 1, 0, 'C');
    // $pdf->Cell(25, 7, 'Periode', 1, 0, 'C');
    $pdf->Cell(40, 7, 'Hasil Akhir', 1, 0, 'C');
    $pdf->Ln();

    // Isi tabel
    foreach ($data as $row) {
        $pdf->Cell(22, 7, $row['peringkat'], 1);
        $pdf->Cell(80, 7, substr($row['nama_alternatif'], 0, 35), 1); // Batasi nama menjadi 20 karakter
        $pdf->Cell(43, 7, substr($row['jabatan1'], 0, 17), 1); // Batasi jabatan menjadi 20 karakter
        // $pdf->Cell(25, 7, $row['periode'], 1);
        $pdf->Cell(40, 7, $row['hasil_akhir'], 1);
        $pdf->Ln();
    }

    // Output PDF
    $pdf->Output();
}

// Cek apakah parameter periode telah diset
if (isset($_GET['periode'])) {
    $periode = $_GET['periode'];

    // Mendapatkan data untuk PDF
    $dataForPDF = getDataForPDF($periode);

    // Membuat file PDF
    createPDF($dataForPDF);
} else {
    // Tampilkan pesan error jika parameter tidak ditemukan
    echo 'Parameter periode tidak ditemukan.';
}
