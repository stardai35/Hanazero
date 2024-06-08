<?php 
    include '../koneksi/koneksi.php'; 
    include '../template/admin_header.php'; 
?>

<div class="container">
    <div class="row table-alat">
        <div class="col shadow p-sm-5 rounded">
            <div class="row mb-sm-3">
                <div class="col">
                    <h3>Data Kostum</h3>
                </div>
                <div class="col text-right">
                    <a href="form-alat.php"><button class="btn btn-outline-primary">Tambah</button></a>
                </div>
            </div>
            <table id="tabel" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Nama Karakter</th>
                        <th scope="col">Harga Sewa</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no=0;
                    $result = $conn->query("SELECT * FROM 18073_alat") or die($conn->error);
                    if ($result->num_rows > 0) {       
                        while($row = $result->fetch_assoc()) 
                        {
                    ?>
                    <tr>
                        <th scope="row"><?= ++$no ?></th>
                        <td class="text-center"><img src="../assets/img/<?= $row['gambar'] ?>" alt=".." width="140px"></td>
                        <td><?= $row['nama'] ?></td>
                        <td>Rp.<?= number_format($row['harga_sewa']) ?></td>
                        <td class="text-center">
                            <?php
                            if ($row['jumlah'] > 0) {
                                echo $row['jumlah'];
                            }
                            else {
                                echo "<span class='badge badge-danger'>kosong</span>";
                            }
                        ?>
                        </td>
                        <td><?= $row['keterangan'] ?></td>
                        <td class="text-center">
                            <a href="form-alat.php?id=<?= $row['id_alat'] ?>"><button class="btn btn-warning">Edit</button></a>
                            <a href="hapus-alat.php?id=<?= $row['id_alat'] ?>" onclick="return confirm('anda akan menghapus kostum ini ?')"><button class="btn btn-danger">Hapus</button></a>
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