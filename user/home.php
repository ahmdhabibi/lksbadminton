<?php
require '../database/db.php';
$error = '';
//cek data apakah duplikat 
if (isset($_POST['daftar'])) {
    $peserta = $_POST['peserta'];
    $umur = $_POST['umur'];
    $sekolah = $_POST['sekolah'];
    $kategori = $_POST['kategori'];
    $hp = $_POST['hp'];
    $pembawa = $_POST['pembawa'];

    // check for duplicate data
    $check = mysqli_query($conn, "SELECT * FROM peserta_lks WHERE peserta='$peserta' AND sekolah=(SELECT sekolah FROM kontingen WHERE idkontingen='$sekolah')");
    if (mysqli_num_rows($check) > 0) {
        $error = 'Data sudah terdaftar';
        header('Location: home.php');
    } else {
        // insert new data
        $daftar = mysqli_query(
            $conn,
            "INSERT INTO peserta_lks(idkategori, peserta, umur, sekolah, jeniskategori, hp, pembawa) VALUES ('$kategori','$peserta','$umur',(SELECT sekolah FROM kontingen WHERE idkontingen='$sekolah'),(SELECT jeniskategori FROM kategori WHERE idkategori='$kategori'),'$hp','$pembawa')"
        );
        if ($daftar) {
            header('Location: dataPeserta.php');
        } else {
            $error = 'Gagal menambah data baru';
            header('Location: home.php');
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- bootsraps icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/bootstrap-icons.min.css">
    <!-- Datatables -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <!-- css -->
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <!-- fontawesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- custom css -->
    <link rel="stylesheet" href="../assets/css/custom-css.css">

    <title>Halaman Kontingen</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid" style="margin-right:20px; margin-left:25px;">
            <a class="navbar-brand" href="home.php"><img src="../assets/images/logo.png" alt="Logo" style="height:55px;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto bg-dark">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Daftar Peserta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dataPeserta.php">Informasi Data Peserta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link bg-danger text-white rounded-pill px-3" href="../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-3">
        <div class="container">
            <?php if ($error != '') { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><?= $error; ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <h3>Selamat Datang Calon Peserta Lomba Lks Badminton Tahun 2023</h3>
            <p>Junjung lah sportivitas, Rise to the challenge on the court!</p>
            <div class="row justify-content-start mt-3">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h4 class="mb-0">Form Pendaftaran Lomba Badminton</h4>
                        </div>
                        <div class="card-body">
                            <form action="home.php" method="post">

                                <div class="form-group row mb-3">
                                    <label class="col-md-3 col-form-label">Nama Peserta</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="peserta" placeholder="Masukan Nama Peserta">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-md-3 col-form-label">Umur</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="umur" placeholder="Masukan Umur Peserta">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-md-3 col-form-label">Nama Sekolah</label>
                                    <div class="col-md-9">
                                        <select name="sekolah" class="form-control">
                                            <?php
                                            $ambilsemuadata = mysqli_query($conn, "SELECT * FROM kontingen");
                                            while ($fetcharray =  mysqli_fetch_array($ambilsemuadata)) {
                                                $sekolah = $fetcharray['sekolah'];
                                                $idkontingen = $fetcharray['idkontingen'];
                                            ?>
                                                <option value="<?= $idkontingen; ?>"><?= $sekolah; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-md-3 col-form-label">Jenis Kategori</label>
                                    <div class="col-md-9">
                                        <select name="kategori" class="form-control">
                                            <?php
                                            $ambilsemuadata = mysqli_query($conn, "SELECT * FROM kategori");
                                            while ($fetcharray =  mysqli_fetch_array($ambilsemuadata)) {
                                                $kategori = $fetcharray['jeniskategori'];
                                                $idkategori = $fetcharray['idkategori'];
                                            ?>
                                                <option value="<?= $idkategori; ?>"><?= $kategori; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-md-3 col-form-label">No HP</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="hp" placeholder="Masukan Nomer Hp Peserta">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-md-3 col-form-label">Pembawa</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="pembawa" placeholder="Masukan Nama Pembimbing">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-9 offset-md-3">
                                        <button type="submit" name="daftar" class="btn btn-primary">Daftar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- bootsraps 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../assets/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../assets/js/datatables-simple-demo.js"></script>
</body>

</html>