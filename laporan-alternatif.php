<?php
include_once './includes/session.php';
include_once './includes/api.php';
include_once 'header1.php';
include_once './includes/fpdf/fpdf.php';




// Cari data histori berdasarkan periode yang di-input user
$data = array(); // Inisialisasi array untuk menampung data

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['periode'])) {
    $periode = $_POST['periode'];
    $_SESSION['search_periode'] = $periode;
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
}

?>

<style>
    #btnBackToTop {
        display: none;
        position: fixed;
        bottom: 20px;
        right: 30px;
        z-index: 99;
        font-size: 18px;
        border: none;
        outline: none;
        background-color: red;
        color: white;
        cursor: pointer;
        padding: 15px;
        border-radius: 4px;
    }

    #btnBackToTop:hover {
        background-color: #0056b3;
    }
</style>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb" style="background: transparent; padding:0px;">
                <li><a href="home.php" style="color: #333;">Beranda</a></li>
                <li class="text-success" style="font-weight: bold;">Laporan Alternatif</li>
            </ol>
        </div>
        <div class="col-md-6 text-left">
            <h5>Laporan Alternatif</h5>

            <form action="" method="post">
    <div class="form-group">
        <label>Periode:</label>
        <select class="form-control" name="periode">
            <option></option>
            <?php
            $periode = isset($_POST['periode']) ? $_POST['periode'] : '';

            // Tentukan awal tahun dan jumlah tahun yang akan diiterasi
            $startYear = 2023;
            $endYear = 2025;

            // Iterasi melalui setiap tahun
            for ($year = $startYear; $year <= $endYear; $year++) {
                // Iterasi melalui setiap kuartal
                for ($quarter = 1; $quarter <= 4; $quarter++) {
                    // Tentukan bulan awal dan akhir untuk setiap kuartal
                    switch ($quarter) {
                        case 1:
                            $label = "Januari-Maret $year";
                            break;
                        case 2:
                            $label = "April-Juni $year";
                            break;
                        case 3:
                            $label = "Juli-September $year";
                            break;
                        case 4:
                            $label = "Oktober-Desember $year";
                            break;
                    }

                    // Nilai yang akan dikirimkan dalam form dan digunakan untuk penyimpanan/pencarian
                    $value = $label;

                    // Tentukan apakah opsi ini harus dipilih
                    $selected = ($periode == $value) ? 'selected' : '';

                    // Tampilkan opsi
                    echo "<option $selected value=\"$value\">$label</option>";
                }
            }
            ?>
        </select>
        <br>
        <button type="submit" class="btn btn-danger" name="cari">Cari</button>
    </div>
</form>



            <?php if (isset($_POST['cari'])) : ?>
                <!-- Tombol Cetak PDF -->
                <button type="button" class="btn btn-success" onclick="cetakPDF()">Cetak PDF</button>
                <!-- Tombol Cetak Word -->
                <!-- <button type="button" class="btn btn-success" onclick="cetakWord()">Cetak Word</button> -->
                <br><br>

                <!-- Tampilkan tabel berdasarkan periode yang di-input user yakni atribut alternatif, periode, dan hasil_akhir -->
                <table width="100%" class="table table-striped table-bordered" id="tabeldata">
                    <thead>
                        <tr>
                            <th width="30px">Peringkat</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Periode</th>
                            <th>Hasil Akhir</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>Peringkat</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Periode</th>
                            <th>Hasil Akhir</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        <?php foreach ($data as $row) : ?>
                            <tr>
                                <td class="text-center"><?= $row['peringkat'] ?></td>
                                <td><?= $row['nama_alternatif'] ?></td>
                                <td><?= $row['jabatan1'] ?></td>
                                <td><?= $row['periode'] ?></td>
                                <td><?= $row['hasil_akhir'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php
                // Bersihkan session setelah menampilkan tabel
                unset($_SESSION['search_periode']);
                ?>
            <?php endif; ?>

        </div>
    </div>
</div>

<!-- Tombol Kembali ke Atas -->
<button onclick="topFunction()" id="btnBackToTop" title="Kembali ke Atas">&#8679;</button>

<!-- Tambahkan script ini setelah tabel -->
<script>
    window.onscroll = function() {
        scrollFunction();
    };

    function scrollFunction() {
        var btnBackToTop = document.getElementById("btnBackToTop");
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            btnBackToTop.style.display = "block";
        } else {
            btnBackToTop.style.display = "none";
        }
    }

    function topFunction() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
        // document.body.scrollTop = 0; // Untuk Safari
        // document.documentElement.scrollTop = 0; // Untuk Chrome, Firefox, IE, dan Opera
    }


    function cetakPDF() {
        // Pastikan $periode sudah didefinisikan dan memiliki nilai
        var periode = '<?= isset($periode) ? htmlspecialchars($periode) : '' ?>';

        // Encode nilai periode jika diperlukan
        var encodedPeriode = encodeURIComponent(periode);

        // Kirim permintaan cetak PDF ke server
        var url = 'cetak-pdf.php?periode=' + encodedPeriode;
        window.open(url, '_blank'); // Menggunakan window.open untuk membuka URL dalam tab baru
    }
</script>





<?php include_once 'footer.php'; ?>