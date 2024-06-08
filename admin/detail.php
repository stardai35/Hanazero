<?php 
    include '../koneksi/koneksi.php'; 
    include '../template/admin_header.php'; 
?>

<div class="container">
    <div class="row table-alat">
        <div class="col shadow p-sm-5 rounded">
            <div class="row mb-sm-3">
                <div class="row mb-sm-3">
                    <div class="col">
                        <h4>Detail Sewa : <?= @$_GET['id'] ?></h4>
                        <small>Daftar detail kostum yang disewa</small>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Gambar</th>
                            <th scope="col">Nama Karakter</th>
                            <th scope="col">Jumlah Sewa</th>
                            <th scope="col">Harga Sewa</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    $id=@$_GET['id'];
                    $result = $conn->query("SELECT a.jumlah jml, b.*, (b.harga_sewa*a.jumlah) total FROM 18073_d_sewa a, 18073_alat b WHERE a.id_alat=b.id_alat AND a.id_sewa='$id'") or die($conn->error);
                    if ($result->num_rows > 0) {       
                    while($row = $result->fetch_assoc()) 
                    {
                ?>
                        <tr>
                            <th scope="row"><img src="../assets/img/<?= $row['gambar'] ?>" alt=".."></th>
                            <td><?= $row['nama'] ?></td>
                            <td class="text-center"><?= $row['jml'] ?></td>
                            <td>Rp.<?= number_format($row['harga_sewa']) ?></td>
                            <td>Rp.<?= number_format($row['total']) ?></td>
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
</div>

    <?php include '../template/admin_footer.php'; ?>