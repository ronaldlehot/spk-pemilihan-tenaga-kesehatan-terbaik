<?php
session_start();
include_once './includes/api.php';
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $q = $koneksi->prepare("SELECT * FROM pengguna WHERE username='$username'");
    $q->execute();
    if ($q->rowCount() > 0) {
        $q = $koneksi->prepare("SELECT * FROM pengguna WHERE username='$username' AND password=SHA2('$password', 0)");
        $q->execute();
        if ($q->rowCount() > 0) {
            $q = $koneksi->prepare('SELECT UUID()');
            $q->execute();
            $uuid = @$q->fetchAll()[0][0];
            $q = $koneksi->prepare("INSERT INTO masuk VALUE ('$uuid', '$username')");
            $q->execute();
            setcookie('masuk', $uuid, time() + 3600 * 24 * 30 * 12);
            $_SESSION['login_success'] = true;
            header('Location: home.php');
        } else echo "<script>alert('password anda salah, silahkan login ulang !')</script>";
    } else echo "<script>alert('username anda salah, silahkan login ulang !')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Metode AHP (Analitycal Hierarchy Process) : Sistem Pendukung Keputusan</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- My Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: Poppins;
        }

        .navbar-brand {
            color: #0A9343;
            font-weight: 500 !important;
            font-size: 24px;
        }

        .button {
            background-color: #E3A413;
            border: none !important;
            border-radius: 10px;
        }

        .button:hover {
            background-color: #E3A413 !important;
            border: #E3A413 !important;
            box-shadow: 2px 2px rgba(255, 255, 255, 0.2);
            color: white;
        }

        .panel {
            background-color: transparent !important;
            color: white;
            border: 0px transparent !important;
            box-shadow: none;
        }

        .form-control {
            color: #fff;
            border: none !important;
        }

        .login {
            display: grid !important;
        }

        .panel-body h4 {
            color: white;
        }

        .login .button {
            padding: 10px 4px;
            box-shadow: none;
            margin-bottom: 5px;
        }

        .register {
            color: white;
            margin-top: 5px;

        }
    </style>
</head>

<body style="background: #ffffff url(images/bg/bg.png); background-size:cover;">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6 mt-5">
                <img src="images/login.svg" style="margin-top: 200px;" alt="" width="350">
            </div>
            <div class="col-md-5">
                <div style="margin-top: 120px;" class="panel panel-default">
                    <div class="panel-body" style="background-color: transparent;">
                        <div class="text-center">
                            <img src="images/puskesmas.png" alt="" width="50">
                            <h4 class="font-weight-normal mb-3">Silahkan Login</h4>
                        </div>
                        <form method="post">
                            <div class="form-group">
                                <label for="username" class="fw-light">Nama Pengguna</label>
                                <input type="text" class="form-control text-left bg-transparent border p-2 py-2 mt-2 text-white" name="username" id="username">
                            </div>
                            <div class="form-group mt-2">
                                <label for="password" class="fw-light">Kata Sandi</label>
                                <input type="password" class="form-control text-left bg-transparent  border p-2 py-2 mt-2 text-white " name="password" id="password">
                                <input type="checkbox" onclick="myFunction()">Show Password
                            </div>
                            <div class="login mt-4">
                                <button type="submit" class="button btn border text-white">Login</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.3.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>