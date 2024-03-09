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

    <title>LKS Badminton || 2023</title>
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

    <section class="text-white py-5" style="background:#010101;" id="home">
        <div class="container-fluid">
            <div class="row align-items-center ms-3">
                <div class="col-md-6">
                    <h2>SELAMAT DATANG DI WEBSITE LOMBA KOMPETENSI SISWA / SISWI BADMINTON</h2>
                    <p>Lomba Kompetensi Siswa/Siswi memberikan kesempatan kepada peserta untuk berkompetisi secara sehat dan mengembangkan bakat dan minat</p>
                    <p>tetapi juga memperluas wawasan dan pengalaman mereka. Dengan berkompetisi secara sehat, peserta dapat belajar menghargai keberhasilan dan kegagalan, memperbaiki diri, dan membangun karakter yang kuat. Selain itu, lomba ini juga menjadi ajang untuk memperkenalkan potensi siswa/siswi kepada dunia luar dan membuka peluang untuk meraih prestasi yang lebih tinggi di masa depan. Mari bergabung dan jadilah bagian dari komunitas siswa/siswi yang berprestasi dan berpotensi!</p>
                    <button class="btn btn-primary read-more-btn">Baca Selengkapnya</button>
                </div>
                <div class="col-md-6">
                    <img src="assets/images/actionBadminton.jpg" class="img-fluid" alt="Gambar Artikel">
                </div>
            </div>
        </div>
    </section>

    <section class="pt-4" style="background-color: #bfbbaf;" id="news">
        <div class="container">
            <h2 class="text-center mb-5">Berita Lomba</h2>
            <div class="row">
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                    <div class="card h-100 border-1" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                        <img src="assets/images/berita1.jpeg" class="card-img-top" alt="Mahasiswa pamulang">
                        <div class="card-body">
                            <h5 class="card-title">Kedatangan Mahasiswa/Mahasiswi Pamulang</h5>
                            <p class="card-text">Para Mahasiswa/ Siswi Pamulang ikut menyaksikan pertandingan yang diadakan di...</p>
                            <a href="#" class="btn btn-primary">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
                    <div class="card h-100 border-1" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                        <img src="assets/images/berita2.PNG" class="card-img-top" alt="Juara Umum Kota Tangerang">
                        <div class="card-body">
                            <h5 class="card-title">Kota Tangerang Menjadi Juara Umum</h5>
                            <p class="card-text">Kota Tangerang akhirnya menjadi juara umum dalam ajang Kejuaraan Bulu Tangkis Antar Satuan Pendidikan SMA/SMK se-Provinsi Banten...</p>
                            <a href="#" class="btn btn-primary">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                    <div class="card h-100" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                        <img src="assets/images/berita3.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Sejarah Bulu Tangkis</h5>
                            <p class="card-text">Cabang olahraga badminton menjadi salah satu di antara beberapa cabang olahraga lainnya yang cukup dikenal oleh banyak orang Indonesia dan juga dunia...</p>
                            <a href="#" class="btn btn-primary">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-2 bg-light" id="information" style="height: 100vh;">
        <div class="container my-5">
            <h1 class="mb-4 text-center">Informasi Lomba</h1>
            <h2 class="mt-5">Alamat Perusahaan : </h2>
            <p>Jl. Indonesia Raya Kec. merah putih</p>
            <h2 class="mt-3">Aturan-aturan LKS Badminton Tingkat SMK</h2>
            <ul>
                <li>Peserta merupakan siswa/siswi aktif dari sekolahan nya masing-masing</li>
                <li>Masing masing sekolah harus menyertakan team nya sesuai keputusan yang berlaku</li>
                <li>tidak boleh bergender waria</li>
                <li>Perlengkapan yang harus dibawa oleh peserta: raket, sepatu badminton, dan seragam olahraga sekolah</li>
                <li>waktu kedatangan 15 harus sudah sampai sebelum lomba dimulai</li>
                <li>peserta yang meninggalkan pertandingan pada saat dipanggil dianggap Ko</li>
                <li>Pemenang ditentukan berdasarkan skor terbanyak dalam 3 set</li>
            </ul>
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