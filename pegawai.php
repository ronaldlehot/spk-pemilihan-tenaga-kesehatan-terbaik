<?php
include_once './includes/api.php';
include_once 'header2.php';





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
                <li class="text-success" style="font-weight: bold;">Data</li>
            </ol>
        </div>
        <div class="col-md-6 text-left">
            <h5>Data</h5>

        </div>
    </div>
</div>
<form method="get" action="">
    <label for="periode">Pilih Periode: </label>
    <select id="periode" name="periode" onchange="this.form.submit()" style="width: 70px; height: 30px;">
        <?php
        // Ambil data periode yang tersedia
        $q_periode = $koneksi->prepare("SELECT DISTINCT periode FROM laporan_alternatif");
        $q_periode->execute();
        $periodes = $q_periode->fetchAll(PDO::FETCH_COLUMN);

        // Definisikan variabel $selected_periode
        $selected_periode = isset($_GET['periode']) ? $_GET['periode'] : '';

        foreach ($periodes as $p) : ?>
            <option value="<?= $p ?>" <?= ($p == $selected_periode) ? 'selected' : '' ?>><?= $p ?></option>
        <?php endforeach; ?>
    </select>
</form>

<div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<div class="row">


    <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="page-header">
            <h5>Kriteria-Kriteria</h5>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <ol class="list-unstyled">

                    <?php
                    foreach (data_kriteria() as $x) {
                        echo "<li>{$x[1]} ({$x[5]})</li>";
                    }
                    ?>
                </ol>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4" style="float: right;">
        <div class="page-header">
            <h5>Alternatif </h5>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <ol class="list-unstyled">

                    <?php
                    foreach (data_alternatif() as $x) {
                        echo "<li>{$x[1]}</li>";
                    }
                    ?>
                </ol>
            </div>
        </div>
    </div>
</div>


<script>
    var chart1; // globally available
    $(document).ready(function() {
        chart1 = new Highcharts.Chart({
            chart: {
                renderTo: 'container2',
                type: 'column'
            },
            title: {
                text: 'Grafik Perangkingan'
            },
            xAxis: {
                categories: ['Alternatif']
            },
            yAxis: {
                title: {
                    text: 'Jumlah Nilai'
                }
            },
            series: [
                // Ambil data alternatif berdasarkan hasil akhir dari tabel nilai_alternatif
                <?php
                // Ambil data periode yang tersedia
                $q_periode = $koneksi->prepare("SELECT DISTINCT periode FROM laporan_alternatif");
                $q_periode->execute();
                $periodes = $q_periode->fetchAll(PDO::FETCH_COLUMN);
                
                $selected_periode = isset($_GET['periode']) ? $_GET['periode'] : $periodes[0]; // Pilih periode pertama sebagai default
                
                // Ambil data alternatif berdasarkan hasil akhir dari tabel nilai_alternatif
                $q = $koneksi->prepare("SELECT DISTINCT nama_alternatif FROM laporan_alternatif WHERE periode = ?");
                $q->execute(array($selected_periode));
                $q->setFetchMode(PDO::FETCH_NUM);
                
                $data = []; // Pastikan $data diinisialisasi sebelum digunakan
                
                while ($r = $q->fetch()) {
                    $nama_alternatif = $r[0];
                    $q2 = $koneksi->prepare("SELECT hasil_akhir FROM laporan_alternatif WHERE nama_alternatif = ? AND periode = ?");
                    $q2->execute(array($nama_alternatif, $selected_periode));
                    $q2->setFetchMode(PDO::FETCH_NUM);
                    $nilai = array();
                
                    while ($r2 = $q2->fetch()) {
                        $nilai[] = $r2[0];
                    }
                
                    //simpan nama alternatif dan nilai ke dalam variabel $data untuk diurutkan
                    $data[] = array('nama' => $nama_alternatif, 'nilai' => $nilai);
                }
                
                // Urutkan data berdasarkan nilai terbesar ke terkecil
                usort($data, function ($a, $b) {
                    $a = array_sum($a['nilai']);
                    $b = array_sum($b['nilai']);
                    if ($a == $b) {
                        return 0;
                    }
                    return ($a > $b) ? -1 : 1;
                });
                
                // Tampilkan data ke dalam grafik dan tambahkan peringkat dari terbesar ke terkecil
                foreach ($data as $index => $x) {
                    $peringkat = $index + 1; // Menambahkan 1 karena index array dimulai dari 0
                    echo "{name: 'Peringkat {$peringkat} - {$x['nama']}', data: [" . implode(',', $x['nilai']) . "]},";
                }
                
  
  
  


                

                ?>
            ]
        });
    });
</script>

<!-- Tombol Kembali ke Atas -->
<button onclick="topFunction()" id="btnBackToTop" title="Kembali ke Atas">&#8679;</button>

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
</script>

<?php include_once 'footer.php';


?>