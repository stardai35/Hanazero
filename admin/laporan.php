<?php 
    include '../koneksi/koneksi.php'; 
    include '../template/admin_header.php'; 
?>

<div class="container">
    <div class="row">
        <div class="col shadow p-sm-5 rounded">
            <div class="row mb-sm-3">
                <div class="col">
                    <h3>Laporan</h3>
                </div>
            </div>
            <form method="post">
                <div class="form-row">
                    <div class="col">
                        <label>Periode Awal :</label>
                        <input type="date" name="awal" class="form-control" placeholder="Dari Tanggal" value="<?= @$_POST['awal'] ?>" required>
                    </div>
                    <div class="col">
                        <label>Periode Akhir :</label>
                        <input type="date" name="akhir" class="form-control" placeholder="Sampai Tanggal" value="<?= @$_POST['akhir'] ?>" required>
                    </div>
                    <div class="col" style="line-height:6.3">
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                        <a href="print-laporan.php?awal=<?= @$_POST['awal'].'&akhir='.@$_POST['akhir'] ?>" target="_blank"><button type="button" class="btn btn-danger" <?= (!@$_POST) ? 'disabled' : '' ?>>Print</button></a>
                    </div>
                </div>
            </form>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tgl Transaksi</th>
                        <th scope="col">Penyewa</th>
                        <th scope="col">Nama Karakter</th>
                        <th scope="col">Harga Sewa</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Lama Sewa</th>
                        <th scope="col">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no=0;
                    $sum=0;
                    $sql = "SELECT a.lama_sewa, d.id_bayar, e.nama penyewa, d.tgl_bayar, c.nama, b.jumlah, c.harga_sewa, (c.harga_sewa*b.jumlah*a.lama_sewa) sub_total FROM 18073_penyewaan a, 18073_d_sewa b, 18073_alat c, 18073_pembayaran d, 18073_user e  where d.id_sewa=a.id_sewa AND b.id_sewa=a.id_sewa AND b.id_alat=c.id_alat AND a.id_user=e.id_user";
                    if ($_POST){
                        $tgl_awal=$_POST['awal'];
                        $tgl_akhir=$_POST['akhir'];
                        $sql .= " AND tgl_bayar BETWEEN '$tgl_awal' and '$tgl_akhir'";
                    }
                    $result = $conn->query($sql) or die($conn->error);
                    if ($result->num_rows > 0) {       
                        while($row = $result->fetch_assoc()) 
                        {
                    ?>
                    <tr>
                        <td><?= $row['id_bayar'] ?></td>
                        <td><?= $row['tgl_bayar'] ?></td>
                        <td><?= $row['penyewa'] ?></td>
                        <td><?= $row['nama'] ?></td>
                        <td>Rp.<?= number_format($row['harga_sewa']) ?></td>
                        <td class="text-center"><?= $row['jumlah'] ?></td>
                        <td class="text-center"><?= $row['lama_sewa'] ?> Hari</td>
                        <td>Rp.<?= number_format($row['sub_total']) ?></td>
                    </tr>
                    <?php
                        $sum += $row['sub_total'];
                        }
                    }
                ?>
                    <tr>
                        <td colspan="7" class="text-right">Total :</td>
                        <td>Rp.<?= number_format($sum) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



<?php include '../template/admin_footer.php'; ?>