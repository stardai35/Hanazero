<?php 
    include './koneksi/koneksi.php'; 
    include './template/header.php'; 
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-5 bg-white p-sm-4">
            <h4>Daftar</h4>
            <small>Silahkan lengkapi form yang disediakan untuk membuat akun anda. atau kembali ke <a
                    href="index.php">home</a> </small>
            <?php
                if (@$_POST):
                    include './koneksi/koneksi.php';
                    $nama=$_POST['nama'];
                    $telp=$_POST['telp'];
                    $alamat=$_POST['alamat'];
                    $user=$_POST['username'];
                    $pass=$_POST['password'];
                    $konfir=$_POST['konfir'];

                    if (empty($nama) || empty($telp) || empty($alamat) || empty($user) || empty($pass) || empty($konfir)) {
                        echo '<div class="alert alert-danger mt-2" role="alert">Silahkan lengkapi form yang disediakan!</div>';
                    }
                    elseif($pass !== $konfir){
                        echo '<div class="alert alert-danger mt-2" role="alert">Konfimasi Password tidak benar!</div>';
                    }
                    else {
                        $result=$conn->query("SELECT * FROM 18073_user WHERE username='$user'");
                        if ($result->num_rows == 0) {
                            if ($conn->query("INSERT INTO 18073_user VALUES(null, '$nama', '$telp', '$alamat', '$user', MD5('$pass'), 'penyewa')")){
                                echo "<script>alert('Anda berhasil mendaftar, silahkan login');window.location='login.php';</script>";
                            }
                        }
                        else {
                            echo '<div class="alert alert-danger mt-2" role="alert">Username sudah pernah dibuat!</div>';
                        }
                    }
                endif;
            ?>
            <form class="my-2" method="post">
                <div class="form-group">
                    <label>Nama Anda</label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama Anda" required>
                </div>
                <div class="form-group">
                    <label>No. Telp</label>
                    <input type="number" class="form-control" name="telp" placeholder="No. Telp" required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" name="alamat" placeholder="Alamat" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label>Konfimasi Password</label>
                    <input type="password" class="form-control" name="konfir" placeholder="Konfirmasi Password" required>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-sm">Daftar</button>
            </form>
            <small>Sudah punya akun ? login <a href="login.php">disini</a></small>
        </div>
    </div>
</div>

<?php include './template/footer.php'; ?>