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
<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb" style="background: transparent; padding:0px;">
            <li><a href="home.php" style="color: #333;">Beranda</a></li>
            <li class="text-success" style="font-weight: bold;">Data Alternatif</li>
        </ol>
    </div>
    <div class="col-md-6 text-left">
        <h5>Data Alternatif</h5>
    </div>
    <div class="col-md-6 text-right">
        <!-- <button onclick="location.href='upload-data-alternatif.php'" class="btn btn-success">Upload Data</button> -->
        <button onclick="location.href='tambah-alternatif.php'" class="btn btn-success">Tambah Data</button>
    </div>
</div>
<br />

<table width="100%" class="table table-striped table-bordered" id="tabeldata">
    <thead>
        <tr>
            <th width="30px">No</th>
            <th>ID</th>
            <th>Nama </th>
            <th>NIP </th>
            <th>Tempat, Tanggal Lahir</th>
            <th>Jabatan</th>
            <th>Pendidikan Terakhir</th>
            <th>Jenis Kelamin</th>
            <th>Status Kepegawaian</th>
            <th width="100px">Aksi</th>
        </tr>
    </thead>

    <tfoot>
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Nama </th>
            <th>NIP </th>
            <th>Tempat, Tanggal Lahir</th>
            <th>Jabatan</th>
            <th>Pendidikan Terakhir</th>
            <th>Jenis Kelamin</th>
            <th>Status Kepegawaian</th>
            <th>Aksi</th>
        </tr>
    </tfoot>

    <tbody>
        <?php
        $no = 1;
        foreach (data_alternatif() as $row) {
        ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['nama'] ?></td>
                <td><?php echo $row['nip'] ?></td>
                <td><?php echo $row['tempat_lahir'] . ', ' . $row['tanggal_lahir'] ?></td>
                <td><?php echo $row['jabatan'] ?></td>
                <td><?php echo $row['pendidikan_terakhir'] ?></td>
                <td><?php echo $row['jenis_kelamin'] ?></td>
                <td><?php echo $row['status_kepegawaian'] ?></td>
                <td class="text-center">
                    <a href="edit-listalternatif.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                    <a href="hapus-listalternatif.php?id=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirmAndAlert(event)"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>

</table>


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

    function confirmAndAlert(event) {
        if (confirm('Apakah kamu yakin ingin menghapus data ini?')) {
            showAlert();
            return true;
        } else {
            event.preventDefault(); // Mencegah tindakan default dari tautan
            return false;
        }
    }
</script>




<?php
include_once 'footer.php';

// pesan ketika data berhasil ditambahkan
if (isset($_SESSION['pesan'])) {
    echo "
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Data Berhasil Ditambahkan',
                showConfirmButton: false,
                timer: 1500
            });
        </script>";
    unset($_SESSION['pesan']);
} elseif (isset($_SESSION['pesan_gagal'])) {
    echo "
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Data Gagal Ditambahkan',
                showConfirmButton: false,
                timer: 1500
            });
        </script>";
    unset($_SESSION['pesan_gagal']);
}

// pesan ketika data berhasil diubah
if (isset($_SESSION['pesan_sukses'])) {
    echo "
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Data Berhasil Diubah',
                showConfirmButton: false,
                timer: 1500
            });
        </script>";
    unset($_SESSION['pesan_sukses']);
} elseif (isset($_SESSION['pesan_gagal'])) {
    echo "
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Data Gagal Diubah 
                        Nip harus berupa angka',
                showConfirmButton: false,
                timer: 1500
            });
        </script>";
    unset($_SESSION['pesan_gagal']);
}

// pesan ketika data berhasil dihapus
if (isset($_SESSION['pesan_sukses_dihapus'])) {
    echo "
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Data Berhasil Dihapus',
                showConfirmButton: false,
                timer: 1500
            });
        </script>";
    unset($_SESSION['pesan_sukses_dihapus']);
} elseif (isset($_SESSION['pesan_gagal_dihapus'])) {
    echo "
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Data Gagal Dihapus',
                showConfirmButton: false,
                timer: 1500
            });
        </script>";
    unset($_SESSION['pesan_gagal_dihapus']);
}

?>