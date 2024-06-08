<?php
    session_start();
    if (empty($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
        echo "<script>alert('Permission Required!!');window.location='../login.php';</script>";
        die;
    }
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300&display=swap" rel="stylesheet"> 
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    
    <title>Hanazero Costume| Admin</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark admin-navbar py-sm-2 shadow fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <!-- <img src="https://getbootstrap.com/docs/4.5/assets/brand/bootstrap-solid.svg" width="30" height="30"
                    alt="" loading="lazy"> -->
                Hanazero Costume
                <img src="hanazero.jpg" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle align-top" href="#" id="master" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Master Data
                        </a>
                        <div class="dropdown-menu" aria-labelledby="master">
                            <a class="dropdown-item" href="data-user.php">Data Pengguna</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="data-alat.php">Data Kostum</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle align-top" href="#" id="master" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Penyewaan
                        </a>
                        <div class="dropdown-menu" aria-labelledby="master">
                            <a class="dropdown-item" href="pre-sewa.php">Daftar pre-Sewa</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="disewa.php">Daftar Disewa</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="history-transaksi.php">History Transaksi</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="laporan.php">Laporan</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle align-top" href="#" id="navbarDropdownMenuLink" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person-circle mb-1" viewBox="0 0 16 16">
                                <path
                                    d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z" />
                                <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                <path fill-rule="evenodd"
                                    d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z" />
                            </svg>
                            <?= $_SESSION['nama'] ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="../logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>