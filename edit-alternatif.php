<?php
ob_clean(); // Menghapus semua data yang ada di output buffer
ob_start();
include_once './includes/session.php';
include_once './includes/api.php';
include_once 'header1.php';


// ambil id alternatif dari parameter
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    // buat query untuk mengambil semua data nilai_alternatif berdasarkan alternatif menggunakan perulangan
    $q = $koneksi->prepare("SELECT * FROM nilai_alternatif WHERE alternatif = :id");
    $q->bindParam(':id', $id);
    $q->execute();
    $data = $q->fetchAll();
    // buat array kosong untuk menampung data kriteria
    $kriteria = array();
    // buat perulangan untuk mengambil data kriteria
    foreach (data_kriteria() as $x) {
        // buat array kosong untuk menampung data kriteria
        $kriteria[$x[0]] = array();
        // buat perulangan untuk mengambil data nilai_alternatif
        foreach ($data as $y) {
            // jika id_kriteria pada data nilai_alternatif sama dengan id_kriteria pada data kriteria
            if ($y['kriteria'] == $x[0]) {
                // masukkan nilai ke dalam array kriteria
                $kriteria[$x[0]] = $y['nilai'];
            }
        }
    }
    $dataKriteria = $kriteria;
    $qNama = $koneksi->prepare("SELECT * FROM alternatif WHERE id = :id");
    $qNama->bindParam(':id', $id);
    $qNama->execute();
    $dataNama = $qNama->fetch();
    $alternatif = $dataNama['nama'];
} else header('Location: ./data-alternatif.php');


if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $kriteria = $_POST['kriteria'];
    $id_kriteria = $_POST['id_kriteria'];
    $queryDelete = $koneksi->prepare("DELETE FROM nilai_alternatif WHERE alternatif = :id");
    $queryDelete->bindParam(':id', $id);
    $queryDelete->execute();

    foreach ($id_kriteria as $key => $value) {
        $q = $koneksi->prepare("INSERT INTO nilai_alternatif (alternatif, kriteria, nilai) values (:alternatif, :kriteria, :nilai)");
        $q->bindParam(':alternatif', $id);
        $q->bindParam(':kriteria', $value);
        $q->bindParam(':nilai', $kriteria[$key]);
        $q->execute();
    }

    // Update data periode di tabel histori
    $periode = $_POST['periode'];
    $sql = "UPDATE laporan_alternatif SET periode = :periode WHERE alternatif = :id";
    $stmt = $koneksi->prepare($sql);
    $stmt->bindParam(':periode', $periode);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        $_SESSION['pesan_success'] = true;
        header('Location: ./data-alternatif.php');
    } else {
        $_SESSION['pesan_gagal'] = true;
        header('Location: ./data-alternatif.php');
    }
}


ob_end_flush(); // Menghapus semua data yang ada di output buffer
?>




<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="">

                <div class="form-group">
                    <label for="alternatif">Nama Lengkap</label>
                    <input type="text" class="form-control" id="alternatif" name="alternatif" value="<?= htmlspecialchars($alternatif) ?>" readonly>
                </div>

                <?php
                foreach ($dataKriteria as $key => $value) {
                    $q = $koneksi->prepare("SELECT * FROM kriteria WHERE id = :id");
                    $q->bindParam(':id', $key);
                    $q->execute();
                    $data = $q->fetch();
                    $nama = $data['nama'];
                    $atribut = $data['atribut'];
                    $bobot = $data['bobot'];
                    $q = $koneksi->prepare("SELECT * FROM atribut WHERE id = :id");
                    $q->bindParam(':id', $atribut);
                    $q->execute();
                    $data = $q->fetch();
                    $atribut = $data['nama'];
                    echo "<div class=\"form-group\">
                    <label for=\"kriteria$key\">$nama ($atribut)</label>
                    <input type=\"hidden\" name=\"id_kriteria[]\" value=\"$key\">
                    <select class=\"form-control\" id=\"kriteria$key\" name=\"kriteria[]\">";

                    for ($i = 1; $i <= 5; $i++) {
                        if ($value == $i) $s = ' selected';
                        else $s = '';
                        echo "<option$s value=\"$i\">$i</option>";
                    }
                    echo "</select>
                    
                </div>";
                }
                ?>
                <?php
                echo "<div class=\"form-group\">
    <label for=\"periode\">Periode</label>
    <select class=\"form-control\" name=\"periode\">";

                // ambil data periode dari tabel laporan_alternatif berdasarkan alternatif yang dipilih untuk ditampilkan
                $sql = "SELECT periode FROM laporan_alternatif WHERE alternatif = :id";
                $stmt = $koneksi->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $data = $stmt->fetch(PDO::FETCH_ASSOC);

                

                $periode = isset($data['periode']) ? $data['periode'] : '';

                // Tentukan awal tahun dan jumlah tahun yang akan diiterasi
                $startYear = 2023;
                $endYear = 2030;

                // Iterasi melalui setiap tahun
                for ($year = $startYear; $year <= $endYear; $year++) {
                    // Iterasi melalui setiap kuartal
                    for ($quarter = 1; $quarter <= 4; $quarter++) {
                        // Tentukan label dan nilai untuk setiap kuartal
                        switch ($quarter) {
                            case 1:
                                $label = "Januari-Maret $year";
                                $value = "Januari-Maret $year";
                                break;
                            case 2:
                                $label = "April-Juni $year";
                                $value = "April-Juni $year";
                                break;
                            case 3:
                                $label = "Juli-September $year";
                                $value = "Juli-September $year";
                                break;
                            case 4:
                                $label = "Oktober-Desember $year";
                                $value = "Oktober-Desember $year";
                                break;
                        }

                        // Tentukan apakah opsi ini harus dipilih
                        $selected = ($periode == $value) ? ' selected' : '';

                        // Tampilkan opsi
                        echo "<option value=\"$value\"$selected>$label</option>";
                    }
                }

                echo "</select></div>";
                ?>




                <button type="submit" name="update" class="btn btn-danger">Update</button>
                <button type="button" onclick="location.href='alternatif.php'" class="btn btn-danger">Cancel</button>
            </form>
        </div>
    </div>



</div>




<?php


include_once 'footer.php';
?>