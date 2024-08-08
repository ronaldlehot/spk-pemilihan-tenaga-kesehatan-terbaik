<?php
ob_clean(); // Menghapus semua data yang ada di output buffer
ob_start();
include_once './includes/session.php';
include_once './includes/api.php';
include_once 'header1.php';
if (!empty($_POST)) {
    global $koneksi;

    // Periksa apakah nilai yang dibutuhkan ada dalam $_POST
    if (isset($_POST['alternatif']) && isset($_POST['kriteria']) && isset($_POST['periode'])) {
        $alternatif = $_POST['alternatif'];
        $kriteria = $_POST['kriteria'];
        $id_kriteria = $_POST['id_kriteria'];
        $periode = $_POST['periode'];

        // Ambil nama alternatif dari database
        $nama_alternatif_sql = "SELECT nama FROM alternatif WHERE id = :id_alternatif";
        $nama_alternatif_stmt = $koneksi->prepare($nama_alternatif_sql);
        $nama_alternatif_stmt->bindParam(':id_alternatif', $alternatif);
        $nama_alternatif_stmt->execute();
        $nama_alternatif = $nama_alternatif_stmt->fetchColumn();

        foreach ($id_kriteria as $key => $value) {
            // Lakukan pemeriksaan untuk memastikan data belum ada sebelumnya
            $check_sql = "SELECT COUNT(*) as count FROM nilai_alternatif WHERE alternatif = '{$alternatif}' AND kriteria = '{$value}'";
            $check_stmt = $koneksi->query($check_sql);
            $row = $check_stmt->fetch(PDO::FETCH_ASSOC);

            // Jika data sudah ada, tampilkan alert dan hentikan proses penyimpanan
            if ($row['count'] > 0) {
                $_SESSION['pesan_sudah_ada'] = true;
                header('Location: data-alternatif.php');
                exit; // Hentikan proses penyimpanan
            }

            // Jika data belum ada, lanjutkan proses penyimpanan kedalam kedua tabel (nilai_alternatif dan history)
            $data = array(
                'id_alternatif' => $alternatif,
                'id_kriteria' => $value,
                'nilai' => $kriteria[$key],
                'periode' => $periode // Tambahkan nilai periode ke dalam data yang akan disimpan
            );

            // Simpan nama alternatif ke tabel laporan_alternatif
            $sql = "INSERT INTO laporan_alternatif (alternatif, nama_alternatif, periode) VALUES (:id_alternatif, :nama_alternatif,  :periode)";
            $stmt = $koneksi->prepare($sql);
            $stmt->bindParam(':id_alternatif', $alternatif);
            $stmt->bindParam(':nama_alternatif', $nama_alternatif);
            $stmt->bindParam(':periode', $periode);
            $stmt->execute();

            // ambil dan simpan data jabatan dari atribut jabatan di tabel alternatif ke atribut jabatan1 di tabel laporan_alternatif
            $jabatan_sql = "SELECT jabatan FROM alternatif WHERE id = :id_alternatif";
            $jabatan_stmt = $koneksi->prepare($jabatan_sql);
            $jabatan_stmt->bindParam(':id_alternatif', $alternatif);
            $jabatan_stmt->execute();
            $jabatan = $jabatan_stmt->fetchColumn();

            $sql = "UPDATE laporan_alternatif SET jabatan1 = :jabatan WHERE alternatif = :id_alternatif";
            $stmt = $koneksi->prepare($sql);
            $stmt->bindParam(':jabatan', $jabatan);
            $stmt->bindParam(':id_alternatif', $alternatif);
            $stmt->execute();


            // Simpan data ke tabel nilai_alternatif
            $sql = "INSERT INTO nilai_alternatif (alternatif, kriteria, nilai) VALUES (:id_alternatif, :id_kriteria, :nilai )";
            $stmt = $koneksi->prepare($sql);
            $stmt->bindParam(':id_alternatif', $data['id_alternatif']);
            $stmt->bindParam(':id_kriteria', $data['id_kriteria']);
            $stmt->bindParam(':nilai', $data['nilai']);

            // Jika berhasil
            if ($stmt->execute()) {
                $_SESSION['pesan'] = true;
            } else {
                // Jika gagal
                $_SESSION['pesan_gagal'] = true;
            }
        }

        header('Location: data-alternatif.php');
        exit;
    }
}

ob_end_flush();
?>

<style>
    .alert-info {
        position: fixed;
        right: 40px;
        top: 120px;
        width: 40%;


    }

    .scrollable {
        max-height: 200px;
        /* Atur ketinggian maksimum sesuai kebutuhan */
        overflow-y: auto;
        /* Aktifkan overflow vertikal */
    }
</style>


<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form method="post" action="">
                <div class="form-group">
                    <label for="alternatif">Alternative:</label>
                    <select class="form-control" id="alternatif" name="alternatif"> <!-- Ubah name menjadi "nama[]" untuk mendapatkan array -->
                        <?php
                        foreach (data_alternatif() as $x) {
                            echo "<option value=\"{$x[0]}\">{$x[1]}</option>";
                        }
                        ?>
                    </select>
                </div>

                <?php foreach (data_kriteria() as $x) : ?>
                    <div class="form-group">
                        <label for="kriteria<?= $x[0] ?>">Kriteria: <?= $x[1] ?> </label>
                        <input type="hidden" name="id_kriteria[]" value="<?= $x[0] ?>">
                        <select class="form-control" id="kriteria<?= $x[0] ?>" name="kriteria[]">
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>

                    </div>
                <?php endforeach; ?>

                <div class="form-group">
                    <label>Periode</label>
                    <select class="form-control" name="periode">
                        
                        <?php
                        $periode = isset($_POST['periode']) ? $_POST['periode'] : '';

                        // Tentukan awal tahun dan jumlah tahun
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

                                // Gunakan label sebagai value juga
                                $value = $label;

                                // Tentukan apakah opsi ini harus dipilih
                                $selected = ($periode == $value) ? 'selected' : '';

                                // Tampilkan opsi
                                echo "<option $selected value=\"$value\">$label</option>";
                            }
                        }
                        ?>
                    </select>
                </div>



                <button type="submit" class="btn btn-danger">Submit</button>
                <button type="button" onclick="location.href='alternatif.php'" class="btn btn-danger">Kembali</button>
            </form>
        </div>
    </div>

    <div class="col-md-9">
        <div class="alert alert-info scrollable">
            <h4>Catatan:</h4>
            <p>Indikator Disiplin </p>
            <p> 1.Tidak hadir > 10 hari = 5</p>
            <p> 2.Tidak hadir > 7 hari = 4</p>
            <p> 3.Tidak hadir > 5 hari = 3</p>
            <p> 4.Tidak hadir > 4 hari = 2</p>
            <p> 5.Tidak hadir ≤ 3 hari = 1</p>
            </br>
            <p>Indikator Komitmen</p>
            <p> 1. On time = 5</p>
            <p> 2. > 1 hari waktu deadline = 4</p>
            <p> 3. > 5 hari waktu deadline = 3</p>
            <p> 4. > 10 hari waktu deadline = 2</p>
            <p> 5. Tidak mengerjakan sama sekali = 1</p>
            </br>
            <p>Indikator Aman</p>
            <p> 1. ≥ 10 kali melaporkan insiden dan perbaikan = 5</p>
            <p> 2. 6-9 kali melaporkan insiden dan perbaikan = 4</p>
            <p> 3. 3-5 kali melaporkan insiden dan perbaikan = 3</p>
            <p> 4. 1-2 kali melaporkan insiden dan perbaikan = 2</p>
            <p> 5. Tidak pernah melaporkan insiden dan perbaikan = 1</p>
            </br>
            <p>Indikator Inisiatif</p>
            <p> 1. Mampu berdaptasi dalam kurun waktu < 7 hari=5</p>
                    <p> 2. Mampu berdaptasi dalam kurun waktu 7-14 hari = 4</p>
                    <p> 3. Mampu berdaptasi dalam kurun waktu 15-22 hari = 3</p>
                    <p> 4. Mampu berdaptasi dalam kurun waktu 23-30 hari = 2</p>
                    <p> 5. Mampu berdaptasi dalam kurun waktu > 30 hari = 1</p>
                    </br>
                    <p>Indikator Sigap</p>
                    <p> 1. Pengambilan keputusan ≤ 1 hari = 5</p>
                    <p> 2. Pengambilan keputusan 2-5 hari = 4</p>
                    <p> 3. Pengambilan keputusan 6-9 hari = 3</p>
                    <p> 4. Pengambilan keputusan 10-13 hari = 2</p>
                    <p> 5. Pengambilan keputusan > 13 hari = 1</p>
                    </br>
                    <p>Indikator Kerjasama Tim</p>
                    <p> 1. Mampu memberikan ide program kerja tahunan > 5 ide = 5</p>
                    <p> 2. Mampu memberikan ide program kerja tahunan =5 ide = 4</p>
                    <p> 3. Mampu memberikan ide program kerja tahunan 2-4 ide = 3</p>
                    <p> 4. Mampu memberikan ide program kerja tahunan = 1 ide = 2</p>
                    <p> 5. Tidak memberikan ide program kerja tahunan = 1</p>
                    </br>
                    <p>Indikator Fokus Pada Kualitas</p>
                    <p> 1. Keterlibatan dalam sesi evaluasi mutu kinerja kerja = 5 kali = 5</p>
                    <p> 2. Keterlibatan dalam sesi evaluasi mutu kinerja kerja = 4 kali = 4</p>
                    <p> 3. Keterlibatan dalam sesi evaluasi mutu kinerja kerja = 3 kali = 3</p>
                    <p> 4. Keterlibatan dalam sesi evaluasi mutu kinerja kerja = 2 kali = 2</p>
                    <p> 5. Tidak keterlibatan dalam sesi evaluasi mutu kinerja kerja = 1</p>
                    </br>
                    <p>Indikator Kemauan Mengembangkan Diri</p>
                    <p> 1. Partisipasi dalam mengikuti seminat atau workshop > 7 kali = 5</p>
                    <p> 2. Partisipasi dalam mengikuti seminat atau workshop =7 kali = 4</p>
                    <p> 3. Partisipasi dalam mengikuti seminat atau workshop 4-6 kali = 3</p>
                    <p> 4. Partisipasi dalam mengikuti seminat atau workshop 2-3 kali = 2</p>
                    <p> 5. Partisipasi dalam mengikuti seminar atau workshop 1 kali = 1</p>
        </div>
    </div>
</div>

<?php include_once 'footer.php'; ?>