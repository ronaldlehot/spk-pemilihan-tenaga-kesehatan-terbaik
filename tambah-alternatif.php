<?php
ob_clean();  // Membersihkan isi output buffer sebelumnya (jika ada)
ob_start();  // Memulai output buffering baru
include_once './includes/session.php';
include_once './includes/api.php';
include_once 'header1.php';


$pesan = "";
if (!empty($_POST)) {
    $pesan_error = array();
    $nama = $_POST['nama'];
    $nip = $_POST['nip'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jabatan = $_POST['jabatan'];
    $pendidikan = $_POST['pendidikan'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $status_kepegawaian = $_POST['status_kepegawaian'];
    if ($nama == '') array_push($pesan_error, 'Nama alternatif tidak boleh kosong');

    // Cek apakah data nama sudah ada
    $q = $koneksi->prepare("SELECT * FROM alternatif WHERE nama = :nama");
    $q->bindParam(':nama', $nama);
    $q->execute();
    $data = $q->fetch();

    //cek apakah data nip sudah ada
    $q = $koneksi->prepare("SELECT * FROM alternatif WHERE nip = :nip");
    $q->bindParam(':nip', $nip);
    $q->execute();
    $data = $q->fetch();
    if ($data) array_push($pesan_error, 'NIP sudah ada');
    //buat agar batas memasukan angka pada nip hanya 18 digit dan tidak boleh lebih dari 18 digit dan jika di inputkan lebih dari 18 maka tidak bisa di inputkan
    // if (strlen($nip) < 16) array_push($pesan_error, 'NIP tidak boleh kurang dari 16 digit');





    if (empty($pesan_error)) {
        $q = $koneksi->prepare("INSERT INTO alternatif VALUE (NULL, '$nama', '$nip', '$tempat_lahir', '$tanggal_lahir', '$jabatan', '$pendidikan', '$jenis_kelamin', '$status_kepegawaian')");
        $q->bindParam(':nama', $nama);
        $q->bindParam(':nip', $nip);
        $q->bindParam(':tempat_lahir', $tempat_lahir);
        $q->bindParam(':tanggal_lahir', $tanggal_lahir);
        $q->bindParam(':jabatan', $jabatan);
        $q->bindParam(':pendidikan', $pendidikan);
        $q->bindParam(':jenis_kelamin', $jenis_kelamin);
        $q->bindParam(':status_kepegawaian', $status_kepegawaian);


        // Memeriksa apakah NIP adalah angka atau tidak
        if (!is_numeric($nip)) {
            // Jika NIP bukan angka, arahkan kembali pengguna ke halaman sebelumnya dengan pesan kesalahan
            $_SESSION['pesan_gagal'] = "NIP harus berupa angka.";
            header('Location: ./list-alternatif.php'); // Ganti form.php dengan halaman yang sesuai
            exit;
        }

        // Jika NIP adalah angka, lanjutkan dengan eksekusi query
        if ($q->execute()) {
            $_SESSION['pesan_sukses'] = true;
            header('Location: ./list-alternatif.php');
            exit;
        } else {
            $_SESSION['pesan_gagal'] = true;
            header('Location: ./list-alternatif.php');
            exit;
        }
    }
}
ob_end_flush();
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb" style="background: transparent; padding:0px;">
                <li><a href="home.php" style="color: #333;">Beranda</a></li>
                <li class="text-success" style="font-weight: bold;">Tambah Data Alternatif</li>
            </ol>
        </div>
        <div class="col-md-6 text-left">
            <h5>Tambah Data Alternatif</h5>
            <form method="post">

                <div class="form-group">
                    <label for="nama">Nama Alternatif</label>
                    <input type="text" class="form-control" name="nama" id="nama" required="">

                </div>

                <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="text" class="form-control" name="nip" id="nip" required="" maxlength="18">
                </div>

                <div class="form-group">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" required="">
                </div>

                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" required="">
                </div>
                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <select class="form-control" name="jabatan" id="jabatan" onchange="updatePendidikanOptions()" required>
                        <option value="Analisis Kesehatan">Analisis Kesehatan</option>
                        <option value="Apoteker Ahli Muda">Apoteker Ahli Muda</option>
                        <option value="Asisten Apoteker">Asisten Apoteker</option>
                        <option value="Asisten Apoteker Pelaksana Lanjutan">Asisten Apoteker Pelaksana Lanjutan</option>
                        <option value="Bidan">Bidan</option>
                        <option value="Bidan Mahir">Bidan Mahir</option>
                        <option value="Bidan Pelaksana Lanjutan">Bidan Pelaksana Lanjutan</option>
                        <option value="Bidan Pelaksana">Bidan Pelaksana</option>
                        <option value="Bidan Penyelia">Bidan Penyelia</option>
                        <option value="Dokter">Dokter</option>
                        <option value="Dokter Gigi">Dokter Gigi</option>
                        <option value="Nutrisionis">Nutrisionis</option>
                        <option value="Penyulu Kesehatan Masyarakat">Penyulu Kesehatan Masyarakat</option>
                        <option value="Perawat">Perawat</option>
                        <option value="Perawat Gigi">Perawat Gigi</option>
                        <option value="Perawat Pelaksana Lanjutan">Perawat Pelaksana Lanjutan</option>
                        <option value="Perawat Penyelia">Perawat Penyelia</option>
                        <option value="PLK Penyelia/ ATLM">PLK Penyelia/ ATLM</option>
                        <option value="Pranata Laboratorium">Pranata Laboratorium</option>
                        <option value="Sanitarian">Sanitarian</option>
                        <option value="Tenaga Promkes dan Ilmu Kesehatan">Tenaga Promkes dan Ilmu Kesehatan</option>
                        <option value="Tenaga Sanitasi Lingkungan">Tenaga Sanitasi Lingkungan</option>
                        <option value="Terapis Gigi dan Mulut">Terapis Gigi dan Mulut</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pendidikan">Pendidikan</label>
                    <select class="form-control" name="pendidikan" id="pendidikan" required>
                        <!-- Opsi pendidikan akan diisi berdasarkan pilihan jabatan -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required="">
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status_kepegawaian">Status Kepegawaian</label>
                    <select class="form-control" name="status_kepegawaian" id="status_kepegawaian" required="">
                        <option value="PNS">PNS</option>
                        <option value="PTT DAERAH KOTA KUPANG">PTT DAERAH KOTA KUPANG</option>
                    </select>
                </div>


                <!-- Tombol untuk menambahkan data -->
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="button" onclick="location.href='list-alternatif.php'" class="btn btn-success">Kembali</button>
                <?php if (!empty($pesan_error)) {
                    echo '<hr><div class="alert alert-dismissable alert-danger"><ul>';
                    foreach ($pesan_error as $x) {
                        echo '<li>' . $x . '</li>';
                    }
                    echo '</ul></div>';
                } elseif ($pesan != "") {
                    echo '<hr><div class="alert alert-dismissable alert-success">' . $pesan . '</div>';
                }
                ?>
            </form>

        </div>
    </div>
</div>

<?php include_once 'footer.php'; ?>

<script>
    // Mendefinisikan aturan pendidikan untuk setiap jabatan
    const pendidikanByJabatan = {
        "Analisis Kesehatan": ["D-III", "D-IV", "S1", "S2", "S3"],
        "Apoteker Ahli Muda": ["S1", "S2", "S3"],
        "Asisten Apoteker": ["D-III", "D-IV", "S1", "S2", "S3"],
        "Asisten Apoteker Pelaksana Lanjutan": ["D-III", "D-IV", "S1", "S2", "S3"],
        "Bidan": ["D-III", "D-IV", "S1", "S2", "S3"],
        "Bidan Mahir": ["D-III", "D-IV", "S1", "S2", "S3"],
        "Bidan Pelaksana Lanjutan": ["D-III", "D-IV", "S1", "S2", "S3"],
        "Bidan Pelaksana": ["D-III", "D-IV", "S1", "S2", "S3"],
        "Bidan Penyelia": ["D-III", "D-IV", "S1", "S2", "S3"],
        "Dokter": ["S1", "S2", "S3"],
        "Dokter Gigi": ["S1", "S2", "S3"],
        "Nutrisionis": ["D-III", "D-IV", "S1", "S2"],
        "Penyulu Kesehatan Masyarakat": ["S1", "S2", "S3"],
        "Perawat": ["D-III", "D-IV", "S1"],
        "Perawat Gigi": ["D-III", "D-IV", "S1"],
        "Perawat Pelaksana Lanjutan": ["D-III", "D-IV", "S1"],
        "Perawat Penyelia": ["D-III", "D-IV", "S1", "S2", "S3"],
        "PLK Penyelia/ ATLM": ["D-III", "D-IV", "S1", "S2", "S3"],
        "Pranata Laboratorium": ["D-III", "D-IV", "S1"],
        "Sanitarian": ["D-III", "D-IV", "S1"],
        "Tenaga Promkes dan Ilmu Kesehatan": ["D-III", "D-IV", "S1"],
        "Tenaga Sanitasi Lingkungan": ["D-III", "D-IV", "S1"],
        "Terapis Gigi dan Mulut": ["D-III", "D-IV", "S1", "S2", "S3"]
    };

    function updatePendidikanOptions() {
        const jabatanSelect = document.getElementById('jabatan');
        const pendidikanSelect = document.getElementById('pendidikan');
        const selectedJabatan = jabatanSelect.value;

        // Hapus semua opsi pendidikan yang ada
        while (pendidikanSelect.options.length) {
            pendidikanSelect.remove(0);
        }

        // Dapatkan opsi pendidikan yang sesuai dengan jabatan yang dipilih
        const optionsToUse = pendidikanByJabatan[selectedJabatan] || [];

        // Tambahkan opsi pendidikan ke dropdown
        optionsToUse.forEach(optionText => {
            const option = new Option(optionText, optionText);
            pendidikanSelect.add(option);
        });

        // Pilih opsi pertama sebagai default
        if (optionsToUse.length > 0) {
            pendidikanSelect.selectedIndex = 0;
        }
    }
</script>