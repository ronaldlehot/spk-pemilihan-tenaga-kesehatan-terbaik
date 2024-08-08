<?php
include_once './includes/session.php';
include_once './includes/api.php';
include_once 'header1.php';
require_once './includes/Matrix.php';

if (!empty($_POST)) {
    foreach (array_keys($_POST) as $x) {
        $k1 = explode('-', $x)[0];
        $k2 = explode('-', $x)[1];
        $q = $koneksi->prepare("DELETE FROM bobot_kriteria WHERE kriteria_1='$k1' AND kriteria_2='$k2'");
        $q->execute();
        $q = $koneksi->prepare("INSERT INTO bobot_kriteria VALUE ('$k1', '$k2', '{$_POST[$x]}')");
        $q->execute();
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


<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb" style="background: transparent; padding:0px;">
                    <li><a href="home.php" style="color: #333;">Beranda</a></li>
                    <li class="text-success" style="font-weight: bold;">Perbadingan Kriteria</li>
                </ol>
            </div>
            <div class="col-md-12 text-left">
                <h5>Perbadingan Kriteria</h5>

                <?php
                $kriteria = data_kriteria();
                echo '<form id="form-perbandingan-matrix" method="post" class="mx-auto" autocomplete="off"><div class="custom-control custom-radio">';
                for ($x = 0; $x < count($kriteria); $x++) {
                    for ($y = $x + 1; $y < count($kriteria); $y++) {
                        $b = bobot_kriteria($kriteria[$x][0], $kriteria[$y][0]);
                        if ($b) $b = $b['bobot'];
                ?>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="<?php echo $kriteria[$x][0] . '-' . $kriteria[$y][0]; ?>"><?php echo $kriteria[$x][1] . ' dibandingkan ' . $kriteria[$y][1]; ?></label>
                                        <select name="<?php echo $kriteria[$x][0] . '-' . $kriteria[$y][0]; ?>" id="<?php echo $kriteria[$x][0] . '-' . $kriteria[$y][0]; ?>" class="form-control">
                                            //buat dropdown option dari 1 sampai 9
                                            <option value="1/1" <?php if ($b == '1/1') echo 'selected'; ?>>Sama Penting</option>
                                            <option value="2/1" <?php if ($b == '2/1') echo 'selected'; ?>>Mendekati Sedikit Lebih Penting</option>
                                            <option value="3/1" <?php if ($b == '3/1') echo 'selected'; ?>>Sedikit Lebih Penting</option>
                                            <option value="4/1" <?php if ($b == '4/1') echo 'selected'; ?>>Mendekati Lebih Penting</option>
                                            <option value="5/1" <?php if ($b == '5/1') echo 'selected'; ?>>Lebih Penting</option>
                                            <option value="6/1" <?php if ($b == '6/1') echo 'selected'; ?>>Mendekati Sangat Penting</option>
                                            <option value="7/1" <?php if ($b == '7/1') echo 'selected'; ?>>Sangat Penting</option>
                                            <option value="8/1" <?php if ($b == '8/1') echo 'selected'; ?>>Mendekati Mutlak Penting</option>
                                            <option value="9/1" <?php if ($b == '9/1') echo 'selected'; ?>>Mutlak Penting</option>


                                        </select>


                                    </div>
                                </div>
                            </div>
                        </div>


                <?php

                        //echo "<input value=\"$b\" name=\"{$kriteria[$x][0]}-{$kriteria[$y][0]}\" id=\"{$kriteria[$x][0]}-{$kriteria[$y][0]}\" class=\"form-control\">";
                    }
                }
                echo '<br><div id="pesan-error"></div><button class="btn btn-danger" type="submit"><span class="fas fa-save"></span> Simpan dan Periksa</button></div></form>';
                if (!empty($_POST)) {

                    echo '<hr><h6>Matriks Perbandingan Berpasangan</h6><table class="table table-bordered table-sm table-striped"><tr><td></td>';
                    foreach (data_kriteria() as $x) {
                        echo "<th class=\"text-center\">{$x[1]}</th>";
                    }
                    echo '</tr>';
                    $xx = 0;
                    $data_matrix = array();
                    foreach (data_kriteria() as $x) {
                        echo "<tr><th>{$x[1]}</th>";
                        $yy = 0;
                        foreach (data_kriteria() as $y) {
                            $data_matrix[$xx][$yy] = bobot_kriteria($x[0], $y[0])['nilai'];
                            echo "<td class=\"text-center\">" . bobot_kriteria($x[0], $y[0])['nilai'] . "</td>";
                            $yy++;
                        }
                        echo '</tr>';
                        $xx++;
                    }
                    $matrix = new Math_Matrix($data_matrix);
                    echo '<tr><th>JUMLAH</th>';
                    for ($x = 0; $x < $matrix->getSize()[1]; $x++) { //loop sebanyak jml data di baris (banyaknya kolom)
                        echo '<th class="text-center">' . array_sum($matrix->getCol($x)) . '</th>';
                    }
                    echo '</table>';

                    echo '<hr><h6>Normalisasi Matrix</h6><table class="table table-bordered table-sm table-striped"><tr><td></td>';
                    foreach (data_kriteria() as $x) {
                        echo "<th class=\"text-center\">{$x[1]}</th>";
                    }
                    echo '</tr>';
                    $xx = 0;
                    $data_matrix = array();
                    foreach (data_kriteria() as $x) {
                        echo "<tr><th>{$x[1]}</th>";
                        $yy = 0;
                        foreach (data_kriteria() as $y) {
                            $data_matrix[$xx][$yy] = bobot_kriteria($x[0], $y[0])['nilai'] / array_sum($matrix->getCol($yy));
                            echo "<td class=\"text-center\">" . (bobot_kriteria($x[0], $y[0])['nilai'] / array_sum($matrix->getCol($yy))) . "</td>";
                            $yy++;
                        }
                        echo '</tr>';
                        $xx++;
                    }
                    $matrix_norm = new Math_Matrix($data_matrix);
                    echo '<tr><th>JUMLAH</th>';
                    for ($x = 0; $x < $matrix_norm->getSize()[1]; $x++) { //loop sebanyak jml data di baris (banyaknya kolom)
                        echo '<th class="text-center">' . array_sum($matrix_norm->getCol($x)) . '</th>';
                    }
                    echo '</table>';

                    echo '<hr><h6>Eign Vector/Hasil bobot</h6><table class="table table-bordered table-sm table-striped">';
                    $bobot = array();
                    $kriteria = data_kriteria();
                    $data_matrix = array();
                    for ($x = 0; $x < count($kriteria); $x++) {
                        $b = array_sum($matrix_norm->getRow($x)) / count($matrix_norm->getRow($x));
                        $data_matrix[$x][0] = $b;
                        echo "<tr><th>{$kriteria[$x][1]}</th><td>$b</td></tr>";
                    }
                    echo '</table>';
                    $matrix_eign = new Math_Matrix($data_matrix);

                    $mul_mat = new Math_Matrix($matrix->getData());
                    $mul_mat->multiply($matrix_eign);

                    echo '<hr><h6>Perhitungan Konsistensi</h6><table class="table table-bordered table-sm table-striped">';
                    echo '<th>Kriteria</th><th>Perkalian Matrix</th><th>Perkalian/Bobot</th>';
                    $kriteria = data_kriteria();
                    $data_matrix = array();
                    $jml = 0;
                    for ($x = 0; $x < count($kriteria); $x++) {
                        $t = $mul_mat->getData()[$x][0] / $matrix_eign->getData()[$x][0];
                        $jml += $t;
                        echo "<tr><td>{$kriteria[$x][1]}</td><td>{$mul_mat->getData()[$x][0]}</td><td>$t</td></tr>";
                    }
                    echo '</table>';
                    $t = 1 / count($kriteria) * $jml;
                    echo 't = 1/' . count($kriteria) . '*' . $jml . ' = ' . $t . '<br>';
                    $ci = ($t - count($kriteria)) / (count($kriteria) - 1);
                    echo "CI = ($t-" . count($kriteria) . ')/' . (count($kriteria) - 1) . ' = ' . $ci . '<br>';
                    $ri = array(
                        1 => 0,
                        2 => 0,
                        3 => 0.58,
                        4 => 0.90,
                        5 => 1.12,
                        6 => 1.24,
                        7 => 1.32,
                        8 => 1.41,
                        9 => 1.45,
                        10 => 1.49,
                        11 => 1.51,
                        12 => 1.48,
                        13 => 1.56,
                        14 => 1.57,
                        15 => 1.59
                    );
                    $cr = $ci / $ri[count($kriteria)];
                    if ($cr <= 0.10) {
                        $ok = " <span class=\"bg-primary text-white\">[OKE/KONSISTEN]</span>";
                        //memasukkan ke database
                        for ($x = 0; $x < count($kriteria); $x++) {
                            $b = $matrix_eign->getData()[$x][0];
                            $id = $kriteria[$x][0];
                            $q = $koneksi->prepare("UPDATE kriteria SET bobot='$b' WHERE id='$id'");
                            $q->execute();
                        }
                    } else {
                        $ok = " <span class=\"bg-danger text-white\">[BERMASALAH/TIDAK KONSISTEN]</span>";
                        $q = $koneksi->prepare("UPDATE kriteria SET bobot=NULL");
                        $q->execute();
                    }
                    echo "CR = $ci/" . $ri[count($kriteria)] . ' = ' . $cr . $ok;
                }
                ?>
                <?php

                ?>
            </div>
        </div>
    </div>

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

</body>