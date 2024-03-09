<?php
require '../database/db.php';
$error = '';
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

    <div id="layoutSidenav_content">
        <main>
            <div class="container px-4 mt-3">
                <h1 class="mt-4">Informasi Daftar Peserta</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="home.php">Daftar Peserta</a></li>
                    <li class="breadcrumb-item active">Informasi Daftar Peserta</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Peserta Lomba
                    </div>
                    <div class="card-body">
                        <!-- <button type="button" class="btn btn-primary">Tambah Data</button> -->
                        <div class="table-responsive mt-3">
                            <table class="table table-hover" id="datatablesSimple" style="background-color:white;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Daftar</th>
                                        <th>Nama Peserta</th>
                                        <th>Umur</th>
                                        <th>Sekolah</th>
                                        <th>Jenis Kategori</th>
                                        <th>Hp</th>
                                        <th>Pembimbing</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = mysqli_query($conn, "SELECT * FROM peserta_lks");
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<tr>';
                                        echo '<td>' . $i++  . '</td>';
                                        echo '<td>' . $row['tanggal'] . '</td>';
                                        echo '<td>' . $row['peserta'] . '</td>';
                                        echo '<td>' . $row['umur'] . '</td>';
                                        echo '<td>' . $row['sekolah'] . '</td>';
                                        echo '<td>' . $row['jeniskategori'] . '</td>';
                                        echo '<td>' . $row['hp'] . '</td>';
                                        echo '<td>' . $row['pembawa'] . '</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
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