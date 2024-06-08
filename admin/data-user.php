<?php 
    include '../koneksi/koneksi.php'; 
    include '../template/admin_header.php'; 
?>

<div class="container">
    <div class="row">
        <div class="col shadow p-sm-5 rounded">
            <div class="row mb-sm-3">
                <div class="col">
                    <h3>Data Pengguna</h3>
                </div>
            </div>
            <table id="tabel" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Telp</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Username</th>
                        <th scope="col">Role</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no=0;
                    $result = $conn->query("SELECT * FROM 18073_user") or die($conn->error);
                    if ($result->num_rows > 0) {       
                        while($row = $result->fetch_assoc()) 
                        {
                    ?>
                    <tr>
                        <th scope="row"><?= ++$no ?></th>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['telp'] ?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td><?= $row['username'] ?></td>
                        <td><?= $row['role'] ?></td>
                        <td class="text-center">
                            <a href="hapus-user.php?id=<?= $row['id_user'] ?>" onclick="return confirm('anda akan menghapus user ini ?')"><button class="btn btn-danger">Hapus</button></a>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../template/admin_footer.php'; ?>