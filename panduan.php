<?php
require 'database/db.php';
$error = '';

// login
if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $pwd = $_POST['password'];

    $cekuser = mysqli_query($conn, "SELECT * FROM user where email='$email'");
    $hitung = mysqli_num_rows($cekuser);

    if ($hitung > 0) {
        $ambildatarole = mysqli_fetch_array($cekuser);
        $hashed_pwd = $ambildatarole['password'];

        if (password_verify($pwd, $hashed_pwd)) {
            $role = $ambildatarole['role'];

            if ($role == 'admin') {
                $_SESSION['log'] = 'Logged';
                $_SESSION['role'] = 'Admin';
                header('location: admin');
            } else {
                $_SESSION['log'] = 'True';
                $_SESSION['role'] = 'user';
                header('location: user');
            }
        } else {
            $error = "Password yang anda masukan salah";
            header('location: login.php');
        }
    } else {
        $error = "Akun belum terdaftar!";
        header('location: login.php');
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- bootsraps icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/bootstrap-icons.min.css">
    <!-- Datatables -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <!-- css -->
    <link href="assets/css/styles.css" rel="stylesheet" />
    <!-- fontawesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->

    <!-- custom css -->
    <link rel="stylesheet" href="assets/css/custom-css.css">

    <!-- aos -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <title>Panduan</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #051D40;">
        <div class="container-fluid pt-2 pb-2">
            <a class="navbar-brand ms-4" href="index.php">
                <span>Lomba Komptensi Siswa/Siswi</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav me-2">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#news">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#information">Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="panduan.php">Panduan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link border rounded-pill px-3 text-white" style="background-color: #FF0000;" href="login.php">Login/Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="panduan" class="pt-5" style="height: 100vh;">
        <div class="container">
            <h2>Tata Cara Login</h2>
            <p>1. pada bagian navigasi bar pilih menu login <br>2. lalu masukan email serta password sesuaikan dengan data kalian
                <br>3. bagi kalian yang belum memilii data akun ini silahkan untuk melakukan register <br> 4. jika diantara email dan password anda salah akan muncul notifikasi
                <br>5. jika terdapat notifikasi silahkan silang
            </p>
            <h2>Tata Cara Registrasi</h2>
            <p>1. pada bagian navigasi bar pilih menu login<br>2. lalu perhatikan text dibawah tombol button jika terdapat link register silahkan klik
                <br>3. lalu silahkan masukan data diri anda pastikan sebelum mendaftar bahwa tidak ada pihak dari sekolah yang sama yang telah mendaftar<br> 4. jika terdapat data sekolah yang sama atau email yang sama maka akan muncul notifikasi
                <br>5. jika terdapat notifikasi silahkan silang
            </p>
        </div>
    </section>

    <!-- aos -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <!-- bootsraps 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
</body>

</html>