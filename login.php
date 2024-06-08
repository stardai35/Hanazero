<?php 
    include './koneksi/koneksi.php'; 
    include './template/header.php'; 
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-5 bg-white p-sm-4">
            <h4>Log in</h4>
            <small>Silahkan login dengan username dan password yang anda miliki. atau kembali ke <a href="index.php">home</a> </small>
            <!-- cek login -->
            <?php
                if (@$_POST):
                    include './koneksi/koneksi.php';
                    $user=$_POST['user'];
                    $pass=$_POST['password'];

                    if (empty($user) || empty($pass)) {
                        echo '<div class="alert alert-danger mt-2" role="alert">Username atau Password tidak boleh kosong!</div>';
                    }
                    else {
                        $result=$conn->query("SELECT * FROM 18073_user WHERE username='$user' AND password=MD5('$pass')");
                        if ($result->num_rows > 0) {
                            $row=$result->fetch_assoc();
                            session_start();
                            $_SESSION['id']=$row['id_user'];
                            $_SESSION['nama']=$row['nama'];
                            $_SESSION['role']=$row['role'];
                            if ($row['role'] == 'admin') {
                                header('location:admin/index.php');
                            }
                            elseif ($row['role']=='penyewa'){
                                header('location:index.php');
                            }
                        }
                        else {
                            echo '<div class="alert alert-danger mt-2" role="alert">Username atau Password anda Salah!</div>';
                        }
                    }
                endif;
            ?>
            <form class="my-2" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="user" placeholder="Username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-sm">Login</button>
            </form>
            <small>Belum punya akun ? daftar <a href="daftar.php">disini</a></small>
        </div>
    </div>
</div>

<?php include './template/footer.php'; ?>