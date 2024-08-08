<?php
include_once './includes/api.php';




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Administrasi</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/dataTables.bootstrap.min.css" rel="stylesheet">
    <script src="./js/jquery.min.js"></script>
    <!-- Include Typed.js library -->
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

    <!-- Include Animate.css library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <!-- My Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">


    <style>
        body {
            font-family: Poppins;
        }

        nav {
            background-color: #0A9343;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        nav .navbar-brand {
            font-weight: bold;
            font-size: 18px !important;
        }
        
        
        .navbar-custom {
            background-color: #0A9343;
            padding-top: 5px;
            padding-bottom: 5px;
        }
        .navbar-custom .navbar-toggle .icon-bar {
            background-color: #fff;
        }

        a {
            color: #fff;
            display: flex;
            gap: 10px;
        }

        a img {
            margin-top: -10px;
        }

        .panel {
            background-color: white;
            border: none !important;
        }

        a:hover {
            background-color: transparent !important;
            color: #E3A413 !important;
            font-weight: bold;
        }

        .navbar-brand img {
            display: inline-block;
            vertical-align: middle;
        }
        #typed-text {
            display: inline-block;
            vertical-align: middle;
        }

    </style>
</head>
<body>

    <nav class="navbar navbar-custom">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php">
                    <img id="navbar-image" src="images/puskesmas.png" alt="" width="58" height="50" class="mb-3">
                    <span id="typed-text"></span>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="home.php">Beranda</a></li>
                    <?php if (akses_pengguna(array(0))) : ?>
                        <li><a href="list-alternatif.php">Data Alternatif</a></li>
                        <li><a href="laporan-alternatif.php">Laporan Alternatif</a></li>
                        <li><a href="manajemen-pengguna.php">Manajemen Pengguna</a></li>
                    <?php endif; ?>


                    <?php if (akses_pengguna(array(2))) : ?>
                        <li><a href="data-kriteria.php">Data Kriteria</a></li>
                        <li><a href="perbandingan-kriteria.php">Perbandingan Kriteria</a></li>

                        <li><a href="alternatif.php">Alternatif</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></span>Analisa Alternatif <span class="caret"></span></a>
                            <ul class="dropdown-menu">

                            <li><a href="data-alternatif.php">Analisa Alternatif</a></li>
                            <li><a href="laporan-alternatif.php">Laporan Alternatif</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    



                </ul>

                <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></span>(<?= pengguna()['keterangan'] ?>) <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="keluar.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <div class="container">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Start the bounce animation and the typing effect at the same time
            var navbarImage = document.getElementById('navbar-image');
            navbarImage.classList.add('animate__animated', 'animate__bounce');
            
            // Initialize Typed.js with a start delay to match the bounce animation duration
            var typed = new Typed('#typed-text', {
                strings: ["SPK AHP dan SAW"],
                typeSpeed: 50,
                backSpeed: 25,
                startDelay: 1500, // Start delay to synchronize with bounce animation
                backDelay: 5000,
                // loop: true
            });

            // Remove the animation class after animation ends to avoid continuous animation
            navbarImage.addEventListener('animationend', function() {
                navbarImage.classList.remove('animate__animated', 'animate__bounce');
            });

            // Re-add the animation class to trigger the animation periodically (optional)
            setInterval(function() {
                navbarImage.classList.add('animate__animated', 'animate__bounce');
            }, 4000); // Adjust the interval as needed
        });
    </script>

</body>

