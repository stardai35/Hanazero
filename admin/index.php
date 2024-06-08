<?php 
    include '../koneksi/koneksi.php'; 
    include '../template/admin_header.php'; 
?>

<div class="container">
    <div class="row">
        <div class="col p-sm-4">
            <div class="jumbotron mb-1">
                <h1 class="display-4">Selamat Datang di Halaman Admin.</h1>
                <p class="lead">Dengan akses admin dapat melakukan pengelolaan data, konfirmasi penyewaan, transaksi pembayaran, dan laporan.</p>
                <hr class="my-4">
                <p>Untuk keluar dari halaman admin anda dapat menekan tombol logout dibawah ini.
                </p>
                <a class="btn btn-outline-danger btn-lg" href="../login.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<?php include '../template/admin_footer.php'; ?>