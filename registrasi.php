<?php
require 'database/db.php';
$error = '';
$succes = '';

// registrasi untuk kontingen
if (isset($_POST['register'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $pwd = $_POST['password'];
    $hp = $_POST['hp'];
    $sekolah = $_POST['sekolah'];
    $alamat = $_POST['alamat'];
    $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);

    // cek email udah ada apa belum
    $cekuser = mysqli_query($conn, "SELECT * FROM user where email='$email'");
    $hitung = mysqli_num_rows($cekuser);

    if ($hitung > 0) {
        // jika email sudah ada
        $error = "Email Telah Terdaftar, Silahkan ganti!";
    } else {
        // cek sekolah udah ada apa belum
        $cekschool = mysqli_query($conn, "SELECT * FROM kontingen where sekolah='$sekolah'");
        $hitungschool = mysqli_num_rows($cekschool);

        if ($hitungschool > 0) {
            // jika sekolah sudah ada
            $error = "Sekolah Telah Terdaftar, Silahkan ganti!";
        } else {
            // jika email dan sekolah belum tersedia, akan di proses di database
            $insertuser = mysqli_query($conn, "INSERT INTO user (fullname, email, password) VALUES ('$fullname', '$email', '$hashed_pwd')");

            //insert data ke tabel kontingen
            $insertkontingen = mysqli_query($conn, "INSERT INTO kontingen (fullname, sekolah, alamat, hp) VALUES ('$fullname', '$sekolah', '$alamat', '$hp')");
            if ($insertuser && $insertkontingen) {
                // jika registrasi berhasil masuk ke login.php
                $succes = "Anda telah berhasil mendaftar, silahkan melakukan login";
                header('location: login.php');
            } else {
                // jika registrasi gagal
                $error = "Registrasi gagal";
                header('location: registrasi.php');
            }
        }
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

    <title>Halaman Register</title>
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
                        <a class="nav-link active" aria-current="page" href=" index.php">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="panduan.php">Panduan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="login-container pt-5">
        <div class="container">
            <div class="row text-white">
                <div class="col-md-6 d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <?php if ($error != '') { ?>
                            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                <strong><?= $error; ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php } ?>
                        <?php if ($succes != '') { ?>
                            <div class="alert alert-succes alert-dismissible fade show mt-2" role="alert">
                                <strong><?= $succes; ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php } ?>
                        <img src="assets/images/lksBadminton.png" alt="Logo" class="logo-img" style="width: 100%">
                        <div class="follow-text mt-4">Ikuti Kami</div>
                        <div class="social-icons mt-4">
                            <a href="#"><i class="fa-brands fa-facebook" style="color: #ffffff;"></i></a>
                            <a href="#"><i class="fa-brands fa-twitter" style="color: #ffffff;"></i></a>
                            <a href="#"><i class="fa-brands fa-instagram" style="color: #ffffff;"></i></a>
                            <a href="#"><i class="fa-brands fa-youtube" style="color: #ffffff;"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="text-center mb-2">Registrasi</h2>
                    <form action="registrasi.php" method="post">
                        <div class="mb-2">
                            <label for="fullname" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Masukan Nama Lengkap" required>
                        </div>
                        <div class="mb-2">
                            <label for="sekolah" class="form-label">Nama Sekolah</label>
                            <input type="text" class="form-control" id="sekolah" name="sekolah" placeholder="Masukan Nama sekolah" required>
                        </div>
                        <div class="mb-2">
                            <label for="alamat" class="form-label">Alamat Sekolah</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat Sekolah" required>
                        </div>
                        <div class="mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukan Email Anda" required>
                        </div>
                        <div class="mb-2">
                            <label for="hp" class="form-label">No HP</label>
                            <input type="text" class="form-control" id="email" name="hp" placeholder="Masukan Nomer Telp" required>
                        </div>
                        <div class="mb-2">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                        </div>
                        <button type="submit" class="btn btn-danger" name="register">Register</button>
                        <p class="mt-3">Sekolah anda sudah terdaftar. Silahkan <a href="login.php">Masuk</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>




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