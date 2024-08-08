<?php
ob_clean();  // Membersihkan isi output buffer sebelumnya (jika ada)
ob_start();  // Memulai output buffering baru
include './includes/session.php';
include './includes/api.php';
require_once "./PHPExcel-1.8/Classes/PHPExcel.php";



if (!empty($_FILES)) {
    $eks = explode('.', $_FILES['file']['name']);
    $eks = $eks[count($eks) - 1];
    $file = './upload/' . mt_rand(0, 999999999) . '.' . $eks;
    move_uploaded_file($_FILES['file']['tmp_name'], $file);

    //baca excel
    $excelReader = PHPExcel_IOFactory::createReaderForFile($file);
    $excelObj = $excelReader->load($file);
    unlink($file);
    $worksheet = $excelObj->getSheet(0);
    $baris_terakhir = $worksheet->getHighestRow();

    //set kolom
    $baris_mulai_data = @$_POST['baris'];
    $nama = @$_POST['nama'];
    $nip = @$_POST['nip'];
    $tempat_lahir = @$_POST['tempat_lahir'];
    $tanggal_lahir = @$_POST['tanggal_lahir'];
    $jabatan = @$_POST['jabatan'];
    $pendidikan_terakhir = @$_POST['pendidikan_terakhir'];
    $jenis_kelamin = @$_POST['jenis_kelamin'];
    $status_kepegawaian = @$_POST['status_kepegawaian'];

    // Ambil dan validasi periode
    $periode = isset($_POST['periode']) ? trim($_POST['periode']) : null;
    if (empty($periode) || $periode == "Q") {
        echo "Periode tidak boleh kosong atau bernilai default. Harap isi periode dengan benar.";
        exit;
    }

    // Validasi format periode (perlu disesuaikan dengan elemen select yang ada)
    $allowedPeriods = array(
        "Januari-Maret 2023",
        "April-Juni 2023",
        "Juli-September 2023",
        "Oktober-Desember 2023",
        "Januari-Maret 2024",
        "April-Juni 2024",
        "Juli-September 2024",
        "Oktober-Desember 2024"
    );
    if (!in_array($periode, $allowedPeriods)) {
        echo "Periode tidak valid. Pilih salah satu periode yang tersedia.";
        exit;
    }

    $kriteria = array();
    foreach (data_kriteria() as $x) {
        $kriteria[$x[0]] = $_POST[$x[0]];
    }

    $q = $koneksi->prepare("DELETE FROM nilai_alternatif");
    $q->execute();
    $q = $koneksi->prepare("DELETE FROM alternatif");
    $q->execute();

    for ($baris = $baris_mulai_data; $baris <= $baris_terakhir; $baris++) {
        $q = $koneksi->prepare("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA='$NAMA_DATABASE' AND TABLE_NAME='alternatif'");
        $q->execute();
        $_next_id = @$q->fetchAll()[0][0];
        $_nama = $worksheet->getCell($nama . $baris)->getValue();
        $_nip = $worksheet->getCell($nip . $baris)->getValue();
        $_tempat_lahir = $worksheet->getCell($tempat_lahir . $baris)->getValue();
        $_tanggal_lahir = $worksheet->getCell($tanggal_lahir . $baris)->getValue();
        $_jabatan = $worksheet->getCell($jabatan . $baris)->getValue();
        $_pendidikan_terakhir = $worksheet->getCell($pendidikan_terakhir . $baris)->getValue();
        $_jenis_kelamin = $worksheet->getCell($jenis_kelamin . $baris)->getValue();
        $_status_kepegawaian = $worksheet->getCell($status_kepegawaian . $baris)->getValue();


        $q = $koneksi->prepare("INSERT INTO alternatif VALUE (NULL, '$_nama', '$_nip', '$_tempat_lahir', '$_tanggal_lahir', '$_jabatan', '$_pendidikan_terakhir', '$_jenis_kelamin', '$_status_kepegawaian')"); //insert nama alternatif
        $q->execute();

        foreach (data_kriteria() as $x) { //insert nilai alternatif ke setiap kriteria pada baris ke x
            $_nilai = $worksheet->getCell($kriteria[$x[0]] . $baris)->getValue();
            $_nilai = str_replace(',', '.', $_nilai);
            $q = $koneksi->prepare("INSERT INTO nilai_alternatif VALUE ('$_next_id', '{$x[0]}', '$_nilai')");
            $q->execute();
        }

        //simpan id alternatif dan periode ke tabel histori
        $alternatif = $_next_id;
        $nama_alternatif = $_nama;
        $jabatan1 = $_jabatan;

        // hapus data histori sebelumnya jika ada data histori dengan nama alternatif dan periode yang sama
        $q = $koneksi->prepare("DELETE FROM laporan_alternatif WHERE nama_alternatif = :nama_alternatif AND periode = :periode");
        $q->bindParam(':nama_alternatif', $nama_alternatif);
        $q->bindParam(':periode', $periode);
        $q->execute();

        $sql = "INSERT INTO laporan_alternatif (alternatif, nama_alternatif, jabatan1, periode) VALUES (:alternatif, :nama_alternatif, :jabatan1, :periode)";
        $stmt = $koneksi->prepare($sql);
        $stmt->bindParam(':alternatif', $alternatif);
        $stmt->bindParam(':nama_alternatif', $nama_alternatif);
        $stmt->bindParam(':jabatan1', $jabatan1);
        $stmt->bindParam(':periode', $periode);



        // Jika berhasil
        if ($stmt->execute()) {
            $_SESSION['pesan'] = true;
        } else {
            $_SESSION['pesan'] = false;
        }
        $q = $koneksi->prepare("DELETE FROM tanggapan WHERE 1"); //hapus tanggapan
        $q->execute();
    }
    header('Location: data-alternatif.php');
} else {
    include 'header1.php';
    ob_end_flush();
?>

    <h5><span class="fas fa-upload"></span> Upload Data Alternatif</h5>
    <hr>
    <form enctype="multipart/form-data" method="post" id="form-upload-data-siswa">
        <div class="custom-file mb-2 mr-sm-2">
            <input class="custom-file-input" name="file" id="file" required type="file" accept=".xls,.xlsx">
            <label class="custom-file-label" for="file">File Excel</label>

        </div>

        <a href="./upload/contoh-data-alternatif.xlsx" class="btn btn-success mb-2 mr-sm-2"><span class="fas fa-download"></span> Download Contoh File Excel</a>
        <i class="fas fa-question fa-2x" id="clipboard-icon" style="margin-left: 3%;  cursor: pointer;"></i>

        <div class="form-group row">
            <label for="periode" class="col-sm-3 col-form-label">Periode:</label>
            <div class="col-sm-3">
                <select class="form-control" id="periode" name="periode" required>
                    <option value="" disabled selected>Pilih Periode</option>
                    <option value="Januari-Maret 2023">Januari-Maret 2023</option>
                    <option value="April-Juni 2023">April-Juni 2023</option>
                    <option value="Juli-September 2023">Juli-September 2023</option>
                    <option value="Oktober-Desember 2023">Oktober-Desember 2023</option>
                    <option value="Januari-Maret 2024">Januari-Maret 2024</option>
                    <option value="April-Juni 2024">April-Juni 2024</option>
                    <option value="Juli-September 2024">Juli-September 2024</option>
                    <option value="Oktober-Desember 2024">Oktober-Desember 2024</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-sm-3 col-form-label">Kolom Nama Alternatif:</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Kolom nama alternatif" value="A" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="nip" class="col-sm-3 col-form-label">Kolom NIP:</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="nip" name="nip" placeholder="Kolom NIP" value="B" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="tempat_lahir" class="col-sm-3 col-form-label">Kolom Tempat Lahir:</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Kolom tempat lahir" value="C" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="tanggal_lahir" class="col-sm-3 col-form-label">Kolom Tanggal Lahir:</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Kolom tanggal lahir" value="D" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="jabatan" class="col-sm-3 col-form-label">Kolom Jabatan:</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Kolom jabatan" value="E" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="pendidikan_terakhir" class="col-sm-3 col-form-label">Kolom Pendidikan Terakhir:</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir" placeholder="Kolom pendidikan terakhir" value="F" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="jenis_kelamin" class="col-sm-3 col-form-label">Kolom Jenis Kelamin:</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" placeholder="Kolom jenis kelamin" value="G" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="status_kepegawaian" class="col-sm-3 col-form-label">Kolom Status Kepegawaian:</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="status_kepegawaian" name="status_kepegawaian" placeholder="Kolom status kepegawaian" value="H" required>
            </div>
        </div>



        <div class="form-group row">
            <label for="baris" class="col-sm-3 col-form-label">Baris Mulai Data:</label>
            <div class="col-sm-3">
                <input type="number" class="form-control" id="baris" name="baris" placeholder="Baris mulai data" value="7" required>
            </div>
        </div>
        <input type="hidden" name="abaikan">
        <?php $k = 73;
        foreach (data_kriteria() as $x) { ?>
            <div class="form-group row">
                <label for="<?= $x[0] ?>" class="col-sm-3 col-form-label">Kolom <?= $x[1] ?>:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="<?= $x[0] ?>" name="<?= $x[0] ?>" placeholder="Kolom alternatif <?= $x[1] ?>" value="<?= chr($k) ?>" required>
                </div>
            </div>
        <?php $k++;
        } ?>


        <button class="btn btn-danger" id="upload" type="submit"><span class="fas fa-upload"></span> Upload</button>

        <button onclick="location.href='alternatif.php'" class="btn btn-danger">Kembali</button>
    </form>
<?php }
include 'footer.php'; ?>

<script>
    // Menggunakan SweetAlert untuk menampilkan modal
    document.getElementById("clipboard-icon").addEventListener("click", function() {
        Swal.fire({
            title: "CATATAN PENTING!",
            text: "Untuk menghindari kesalahan, pastikan format file excel sesuai dengan contoh file excel yang telah disediakan dan form penilaian tidak boleh kosong dan tidak boleh ada angka nol. Jika terdapat kesalahan, silahkan hubungi admin.",
            icon: "question"
        });
    });


    document.getElementById('periode').addEventListener('input', function() {
        var periodePattern = /^[A-Za-z]+-[A-Za-z]+ \d{4}$/;
        var periodeInput = document.getElementById('periode').value;
        if (!periodePattern.test(periodeInput)) {
            document.getElementById('periode').setCustomValidity('Format periode harus seperti "Januari-Maret 2023".');
        } else {
            document.getElementById('periode').setCustomValidity('');
        }
    });
</script>