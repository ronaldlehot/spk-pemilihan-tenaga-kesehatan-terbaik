<?php
ob_start();
include_once './includes/session.php';
include_once './includes/api.php';

if (!empty($_POST)) {
    $pesan_error = array();
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    if ($nama=='') array_push($pesan_error, 'Nama kriteria tidak boleh kosong');

    // Cek apakah data nama sudah ada
    $q = $koneksi->prepare("SELECT * FROM kriteria WHERE nama = :nama");
    $q->bindParam(':nama', $nama);
    $q->execute();
    $data = $q->fetch();
    if ($data && $data['id']!=$id) array_push($pesan_error, 'Nama kriteria sudah ada');

    $atribut = $_POST['atribut'];
    if (empty($pesan_error)) {
        $q = $koneksi->prepare("UPDATE kriteria SET nama='$nama', atribut='$atribut' WHERE id='$id'");
        // Eksekusi query update
        if ($q->execute()) {
            $_SESSION['pesan_ubah_sukses'] = true;
        } else {
            $_SESSION['pesan_ubah_gagal'] = true;
        }

        header('Location: ./data-kriteria.php');
        exit();
    }
} else if (!empty($_GET)) {
    @$id = $_GET['id'];
    $q = $koneksi->prepare("SELECT * FROM kriteria JOIN atribut ON kriteria.atribut=atribut.id WHERE kriteria.id='$id'");
    $q->execute();
    @$data = $q->fetchAll()[0];
    if ($data) {
        $id = $data[0];
        $nama = $data[1];
        $atribut = $data[4];
    } else header('Location: ./data-kriteria.php');
} else header('Location: ./data-kriteria.php');

include 'header1.php';
ob_end_flush(); 
?>
<div class="row">
     <div class="col-xs-12 col-sm-12 col-md-8">       
        <div class="page-header">
            <h5>Ubah Kriteria</h5>
        </div>
        <form method="post"  >
            <input type="hidden" name="id" value="<?=$id?>">
            <label class="form-group" for="nama">Nama Kriteria</label>
            <input id="nama" name="nama" class="form-control mb-2 mr-sm-2" type="text" value="<?=$nama?>">
            <label class="form-group" for="atribut">Atribut</label>
            <select id="atribut" name="atribut" class="form-control mb-2 mr-sm-2">
            <?php
            foreach (data_atribut() as $x) {
                if ($x['id']==$atribut) $s = ' selected';
                else $s = '';
                echo "<option$s value=\"{$x['id']}\">{$x['nama']}</option>";
            }
            ?>
            </select>
            <br>
            <button class="btn btn-success" type="submit"><span class="fas fa-save"></span> Simpan</button>
            <button class="btn btn-success" type="reset" onclick="location.href='./data-kriteria.php'"><span class="fas fa-times"></span> Batal</button>
            <?php if (!empty($pesan_error)) {
                echo '<hr><div class="alert alert-dismissable alert-danger"><ul>';
                foreach ($pesan_error as $x) {
                    echo '<li>'.$x.'</li>';
                }
                echo '</ul></div>';
            }
            ?>
        </form>
     </div>
</div>
<?php include 'footer.php';?>