<?php
ob_clean(); // Menghapus semua data yang ada di output buffer
ob_start();
include_once './includes/session.php';
include_once './includes/api.php';
include_once 'header1.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $q = $koneksi->prepare("SELECT * FROM alternatif WHERE id = :id");
    $q->bindParam(':id', $id);
    $q->execute();
    $data = $q->fetch();
    if (empty($data)) header('Location: ./list-alternatif.php');
    $nama = $data['nama'];
    $nip = $data['nip'];
    $tempat_lahir = $data['tempat_lahir'];
    $tanggal_lahir = $data['tanggal_lahir'];
    $jabatan = $data['jabatan'];
    $pendidikan_terakhir = $data['pendidikan_terakhir'];
    $jenis_kelamin = $data['jenis_kelamin'];
    $status_kepegawaian = $data['status_kepegawaian'];
} else header('Location: ./list-alternatif.php');

if (!empty($_POST)) {
    $nama = $_POST['nama'];
    $nip = $_POST['nip'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jabatan = $_POST['jabatan'];
    $pendidikan_terakhir = $_POST['pendidikan_terakhir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $status_kepegawaian = $_POST['status_kepegawaian'];

    $validasi = true;
    $pesan_error = array();

    //buat kondisi agar nama, nip, tempat lahir, tanggal lahir, jabatan, pendidikan terakhir, jenis kelamin, status kepegawaian tidak boleh kosong dan nama,nip yang sudah ada tidak boleh sama
    if (empty($nama)) {
        $validasi = false;
        $pesan_error[] = "Nama tidak boleh kosong.";
    }

    if (empty($nip)) {
        $validasi = false;
        $pesan_error[] = "NIP tidak boleh kosong.";
    }

    if (empty($tempat_lahir)) {
        $validasi = false;
        $pesan_error[] = "Tempat Lahir tidak boleh kosong.";
    }

    if (empty($tanggal_lahir)) {
        $validasi = false;
        $pesan_error[] = "Tanggal Lahir tidak boleh kosong.";
    }



    // Jika NIP DAN NAMA tidak kosong, periksa apakah NIP sudah ada di database atau belum dan buat nip tidak boleh kurang dari 16 digit
    if (!empty($nip)) {
        $q = $koneksi->prepare("SELECT * FROM alternatif WHERE nip = :nip AND id != :id");
        $q->bindParam(':nip', $nip);
        $q->bindParam(':id', $id);
        $q->execute();
        $data = $q->fetch();
        if ($data) {
            $validasi = false;
            $pesan_error[] = "NIP sudah ada.";
        }
        // if (strlen($nip) < 16) {
        //     $validasi = false;
        //     $pesan_error[] = "NIP tidak boleh kurang dari 16 digit.";
        // }
    }



    if (empty($pesan_error)) {
        $q = $koneksi->prepare("UPDATE alternatif SET nama=:nama, nip=:nip, tempat_lahir=:tempat_lahir, tanggal_lahir=:tanggal_lahir, jabatan=:jabatan, pendidikan_terakhir=:pendidikan_terakhir, jenis_kelamin=:jenis_kelamin, status_kepegawaian=:status_kepegawaian WHERE id=:id");
        $q->bindParam(':nama', $nama);
        $q->bindParam(':nip', $nip);
        $q->bindParam(':tempat_lahir', $tempat_lahir);
        $q->bindParam(':tanggal_lahir', $tanggal_lahir);
        $q->bindParam(':jabatan', $jabatan);
        $q->bindParam(':pendidikan_terakhir', $pendidikan_terakhir);
        $q->bindParam(':jenis_kelamin', $jenis_kelamin);
        $q->bindParam(':status_kepegawaian', $status_kepegawaian);
        $q->bindParam(':id', $id);


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

ob_end_flush(); // Menghapus semua data yang ada di output buffer
?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8">
        <div class="page-header">
            <h5>Ubah Data Alternatif</h5>
        </div>

        <form method="post">
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= @$nama ?>">
            </div>

            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" class="form-control" id="nip" name="nip" maxlength="18" value="<?= @$nip ?>">
            </div>

            <div class="form-group">
                <label for="tempat_lahir">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= @$tempat_lahir ?>">
            </div>

            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= @$tanggal_lahir ?>">
            </div>


            <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <select class="form-control" id="jabatan" name="jabatan">
                    <option value="Analisis Kesehatan" <?= @$jabatan == 'Analisis Kesehatan' ? 'selected' : '' ?>>Analisis Kesehatan</option>
                    <option value="Apoteker Ahli Muda" <?= @$jabatan == 'Apoteker Ahli Muda' ? 'selected' : '' ?>>Apoteker Ahli Muda</option>
                    <option value="Asisten Apoteker" <?= @$jabatan == 'Asisten Apoteker' ? 'selected' : '' ?>>Asisten Apoteker</option>
                    <option value="Asisten Apoteker Pelaksana Lanjutan" <?= @$jabatan == 'Asisten Apoteker Pelaksana Lanjutan' ? 'selected' : '' ?>>Asisten Apoteker Pelaksana Lanjutan</option>
                    <option value="Bidan" <?= @$jabatan == 'Bidan' ? 'selected' : '' ?>>Bidan</option>
                    <option value="Bidan Mahir" <?= @$jabatan == 'Bidan Mahir' ? 'selected' : '' ?>>Bidan Mahir</option>
                    <option value="Bidan Pelaksana Lanjutan" <?= @$jabatan == 'Bidan Pelaksana Lanjutan' ? 'selected' : '' ?>>Bidan Pelaksana Lanjutan</option>
                    <option value="Bidan Pelaksana" <?= @$jabatan == 'Bidan Pelaksana' ? 'selected' : '' ?>>Bidan Pelaksana</option>
                    <option value="Bidan Penyelia" <?= @$jabatan == 'Bidan Penyelia' ? 'selected' : '' ?>>Bidan Penyelia</option>
                    <option value="Dokter" <?= @$jabatan == 'Dokter' ? 'selected' : '' ?>>Dokter</option>
                    <option value="Dokter Gigi" <?= @$jabatan == 'Dokter Gigi' ? 'selected' : '' ?>>Dokter Gigi</option>
                    <option value="Nutrisionis" <?= @$jabatan == 'Nutrisionis' ? 'selected' : '' ?>>Nutrisionis</option>
                    <option value="Penyulu Kesehatan Masyarakat" <?= @$jabatan == 'Penyulu Kesehatan Masyarakat' ? 'selected' : '' ?>>Penyulu Kesehatan Masyarakat</option>
                    <option value="Perawat" <?= @$jabatan == 'Perawat' ? 'selected' : '' ?>>Perawat</option>
                    <option value="Perawat Gigi" <?= @$jabatan == 'Perawat Gigi' ? 'selected' : '' ?>>Perawat Gigi</option>
                    <option value="Perawat Pelaksana Lanjutan" <?= @$jabatan == 'Perawat Pelaksana Lanjutan' ? 'selected' : '' ?>>Perawat Pelaksana Lanjutan</option>
                    <option value="Perawat Penyelia" <?= @$jabatan == 'Perawat Penyelia' ? 'selected' : '' ?>>Perawat Penyelia</option>
                    <option value="PLK Penyelia/ ATLM" <?= @$jabatan == 'PLK Penyelia/ ATLM' ? 'selected' : '' ?>>PLK Penyelia/ ATLM</option>
                    <option value="Pranata Laboratorium" <?= @$jabatan == 'Pranata Laboratorium' ? 'selected' : '' ?>>Pranata Laboratorium</option>
                    <option value="Sanitarian" <?= @$jabatan == 'Sanitarian' ? 'selected' : '' ?>>Sanitarian</option>
                    <option value="Tenaga Promkes dan Ilmu Kesehatan" <?= @$jabatan == 'Tenaga Promkes dan Ilmu Kesehatan' ? 'selected' : '' ?>>Tenaga Promkes dan Ilmu Kesehatan</option>
                    <option value="Tenaga Sanitasi Lingkungan" <?= @$jabatan == 'Tenaga Sanitasi Lingkungan' ? 'selected' : '' ?>>Tenaga Sanitasi Lingkungan</option>
                    <option value="Terapis Gigi dan Mulut" <?= @$jabatan == 'Terapis Gigi dan Mulut' ? 'selected' : '' ?>>Terapis Gigi dan Mulut</option>
                </select>
            </div>

            <div class="form-group">
                <label for="pendidikan">Pendidikan Terakhir</label>
                <select class="form-control" id="pendidikan" name="pendidikan_terakhir" data-selected="<?= @$pendidikan_terakhir ?>">
                    <!-- Opsi pendidikan akan diisi berdasarkan pilihan jabatan -->
                </select>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                    <option value="laki-laki" <?= @$jenis_kelamin == 'laki-laki-' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="perempuan" <?= @$jenis_kelamin == 'perempuan' ? 'selected' : '' ?>>Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="status_kepegawaian">Status Kepegawaian</label>
                <select class="form-control" id="status_kepegawaian" name="status_kepegawaian">
                    <option value="PNS" <?= @$status_kepegawaian == 'PNS' ? 'selected' : '' ?>>PNS</option>
                    <option value="PTT DAERAH KOTA KUPANG" <?= @$status_kepegawaian == 'PTT DAERAH KOTA KUPANG' ? 'selected' : '' ?>>PTT DAERAH KOTA KUPANG</option>
                </select>

            </div>



            <button type="submit" class="btn btn-success">Ubah</button>
            <button type="button" onclick="location.href='list-alternatif.php'" class="btn btn-success">Kembali</button>
            <?php if (!empty($pesan_error)) {
                echo '<hr><div class="alert alert-dismissable alert-danger"><ul>';
                foreach ($pesan_error as $x) {
                    echo '<li>' . $x . '</li>';
                }
                echo '</ul></div>';
            }
            ?>
        </form>

    </div>

</div>

<?php
include_once 'footer.php';
?>

<script>
    // Definisikan aturan pendidikan untuk setiap jabatan
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

    document.addEventListener('DOMContentLoaded', () => {
        const jabatanSelect = document.getElementById('jabatan');
        const pendidikanSelect = document.getElementById('pendidikan');

        // Set nilai default jika ada
        if (jabatanSelect.value) {
            updatePendidikanOptions();
            if (pendidikanSelect.value) {
                pendidikanSelect.value = pendidikanSelect.getAttribute('data-selected') || pendidikanSelect.value;
            }
        }

        jabatanSelect.addEventListener('change', updatePendidikanOptions);
    });
</script>