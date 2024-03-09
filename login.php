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
                header('location: user/home.php');
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

    <title>LKS Badminton || 2023</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #051D40;S">
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
                        <a class="nav-link active" aria-current="page" href="index.php">News</a>
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


    <div class="login-container">
        <div class="container">
            <div class="row text-white">
                <div class="col-md-6">
                    <div class="text-center">
                        <?php if ($error != '') { ?>
                            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                <strong><?= $error; ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php } ?>
                        <img src="assets/images/lksBadminton.png" alt="Logo" class="logo-img img-fluid">
                        <div class="follow-text mt-lg-5">Ikuti Kami</div>
                        <div class="social-icons">
                            <a href="#"><i class="fa-brands fa-facebook" style="color: #ffffff;"></i></a>
                            <a href="#"><i class="fa-brands fa-twitter" style="color: #ffffff;"></i></a>
                            <a href="#"><i class="fa-brands fa-instagram" style="color: #ffffff;"></i></a>
                            <a href="#"><i class="fa-brands fa-youtube" style="color: #ffffff;"></i></a>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <h2>Selamat Datang</h2>
                    <p>Calon peserta lomba badminton 2023</p>
                    <form method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-danger" name="login">Login</button>
                        <p class="mt-3">Sekolah anda belum terdaftar? <br> ingin mengikuti ajang ini? Silahkan <a href="registrasi.php">Registrasi</a></p>
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