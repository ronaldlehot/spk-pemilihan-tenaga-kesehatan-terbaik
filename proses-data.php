<?php
include_once './includes/session.php';
include_once './includes/api.php';
include_once 'header1.php';
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

<h5><span class="fas fa-radiation"></span> Proses Data</h5>
<hr>
<h6>Data</h6>
<table class="table table-bordered table-sm table-striped small">
    <tr class="text-center">
        <th>Alternatif</th>
        <?php
        foreach (data_kriteria() as $x) {
            echo "<th>{$x[1]} ({$x[5]})</th>";
        }
        ?>
    </tr>
    <?php
    $data = array();
    foreach (data_alternatif() as $x) {
        echo "<tr><td>{$x[1]}</td>";
        foreach (data_kriteria() as $y) {
            $n = nilai_alternatif($x[0], $y[0]);
            echo "<td>$n</td>";
            $data[$y[0]][$x[0]] = $n;
        }
        echo '</tr>';
    }
    ?>
</table>
<hr>
<h6>Normalisasi</h6>
<table class="table table-bordered table-sm table-striped small">
    <tr class="text-center">
        <th>Alternatif</th>
        <?php
        foreach (data_kriteria() as $x) {
            echo "<th>{$x[1]} ({$x[3]})</th>";
        }
        ?>
    </tr>
    <?php
    $data_normalisasi = array();
    $data_hasil = array();
    foreach (data_alternatif() as $x) {
        echo "<tr><td>{$x[1]}</td>";
        foreach (data_kriteria() as $y) {
            if ($y[2] == 1) $n = nilai_alternatif($x[0], $y[0]) / max($data[$y[0]]);
            else $n = min($data[$y[0]]) / nilai_alternatif($x[0], $y[0]);
            echo "<td>$n</td>";
            $data_normalisasi[$y[0]][$x[0]] = $n;
            $data_hasil[$x[0]][$y[0]] = $n * $y[3];
        }
        echo '</tr>';
    }
    ?>
</table>
<hr>

<?php
$hasil = array();
foreach (array_keys($data_hasil) as $x) {
    $hasil[$x] = array_sum($data_hasil[$x]);
}
arsort($hasil);






?>



<h6>Hasil</h6>
<div id="tempat-hasil">
    <?php
    $q = $koneksi->prepare("SELECT tanggapan FROM tanggapan WHERE id='$TANGGAPAN'");
    $q->execute();
    $akurasi_di_sini = 100;
    if ($q->rowCount() > 0) {
        echo $q->fetchAll()[0]['tanggapan'];
        $q = $koneksi->prepare("SELECT akurasi FROM tanggapan WHERE id='$TANGGAPAN'");
        $q->execute();
        $akurasi_di_sini = $q->fetchAll()[0]['akurasi'];
        echo '<script>__nilai = ' . $akurasi_di_sini . ';</script>';
    } else {
        echo '<script>__nilai = 100;</script>';
    ?>
        <table class="table table-bordered table-sm table-striped small">
            <tr class="text-center">
                <th>Rangking</th>
                <th>Alternatif</th>
                <th>Nilai</th>
                <th>Kesesuaian Pengguna</th>
            </tr>
            <?php
            $no = 1;
            foreach (array_keys($hasil) as $x) {
                $q = $koneksi->prepare("SELECT * FROM alternatif WHERE id='$x'");
                $q->execute();
                @$data = $q->fetchAll()[0];
                @$nama = $data[1];
                @$id =  $data[0];
                echo "<tr id=\"baris-$id\"><td>$no</td><td>$nama</td><td>{$hasil[$x]}</td><td><div class=\"custom-control custom-checkbox text-center\">
                <input type=\"checkbox\" class=\"custom-control-input sesuai\" id=\"sesuai-$id\" checked>
                <label class=\"custom-control-label\" id=\"label-$id\" for=\"sesuai-$id\">Sesuai</label>
                </div></td></tr>";
                $no++;
                $hasil_akhir = $hasil[$x];
                $sql = "UPDATE laporan_alternatif SET hasil_akhir = :hasil_akhir WHERE alternatif = :id_alternatif";
                $stmt = $koneksi->prepare($sql);
                $stmt->bindParam(':hasil_akhir', $hasil_akhir);
                $stmt->bindParam(':id_alternatif', $x);
                $stmt->execute();
            }

            ?>
        </table>
    <?php } ?>
</div>
<h6>Akurasi tanggapan anda: <span id="akurasi-di-sini"><?= $akurasi_di_sini ?> %</span></h6>
<hr>
<!-- <h6>Total akurasi keseluruhan: <span id="akurasi"><span class="bg-warning">menunggu jaringan . .</span></span></h6><hr> -->
<script>
    var __total = <?= @count($hasil) ?>;

    function fetch() {
        $.ajax({
            type: 'POST',
            url: 'tanggapan',
            data: {
                'action': 'fetch'
            },
            success: function(pesan) {
                $('#akurasi').html(pesan);
            },
            error: function(pesan) {
                $('#akurasi').html('<span class="bg-danger text-white">Tidak dapat terhubung ke jaringan</span>');
            }
        });
    }
    setTimeout(() => {
        setInterval(function() {
            fetch();
        }, 1000);
    }, 1000);

    $('.sesuai').click(function(e) {
        if (e.target.checked) {
            e.target.setAttribute("checked", "");
            $('#baris-' + e.target.id.split('-')[1]).removeClass('bg-danger');
            $('#label-' + e.target.id.split('-')[1]).html('Sesuai');
            window.__nilai += (1 / window.__total * 100);
        } else {
            e.target.removeAttribute("checked");
            $('#baris-' + e.target.id.split('-')[1]).addClass('bg-danger');
            $('#label-' + e.target.id.split('-')[1]).html('Tidak sesuai');
            window.__nilai -= (1 / window.__total * 100);
        }
        $('#akurasi-di-sini').html(window.__nilai + ' %');
        $.ajax({
            type: 'POST',
            url: 'tanggapan',
            data: {
                'action': 'push',
                'akurasi': window.__nilai,
                'tanggapan': $('#tempat-hasil').html()
            },
            success: function(pesan) {
                //console.log(pesan);
            }
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


<?php include_once 'footer.php'; ?>