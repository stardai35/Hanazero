<?php 
    include '../koneksi/koneksi.php'; 
    include '../koneksi/function.php'; 
    include '../template/admin_header.php'; 
?>

<div class="container">
    <div class="row">
        <div class="col shadow p-sm-5 rounded">
            <div class="row mb-sm-3">
                <div class="col">
                    <h3>Daftar DiSewa</h3>
                </div>
            </div>
            <table id="tabel" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID Sewa</th>
                        <th scope="col">Penyewa</th>
                        <th scope="col">Tanggal Kembali</th>
                        <th scope="col">Lama Sewa</th>
                        <th scope="col">Jaminan</th>
                        <th scope="col">Biaya Sewa</th>
                        <th scope="col">Uang Muka</th>
                        <th scope="col">Denda</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no=0;
                    $result = $conn->query("SELECT a.*, b.nama FROM 18073_penyewaan a, 18073_user b where a.id_user=b.id_user AND a.status='disewa'") or die($conn->error);
                    if ($result->num_rows > 0) {       
                        while($row = $result->fetch_assoc()) 
                        {
                            $denda=denda($row['tgl_kembali'], $row['biaya_sewa']);   
                            $total=totalBayar($row['biaya_sewa'], $denda, $row['uang_muka']);
                    ?>
                    <tr>
                        <td><?= $row['id_sewa'] ?></td>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['tgl_kembali'] ?></td>
                        <td><?= $row['lama_sewa'] ?> Hari</td>
                        <td><?= $row['jaminan'] ?></td>
                        <td>Rp.<?= number_format($row['biaya_sewa']) ?></td>
                        <td>Rp.<?= number_format($row['uang_muka']) ?></td>
                        <td>Rp.<?= number_format($denda) ?></td>
                        <td><?= $row['keterangan'] ?></td>
                        <td class="text-center">
                            <button class="btn btn-warning my-1" data-toggle="modal"
                                data-target="#transaksi" data-id="<?= $row['id_sewa'] ?>" data-total="<?= $total ?>">Transaksi</button>
                            <a href="detail.php?id=<?= $row['id_sewa'] ?>"><button
                                    class="btn btn-outline-success my-1">Detail</button></a>
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

<!-- Modal -->
<div class="modal fade" id="transaksi" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Transaksi Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="transaksi.php" method="post" id="bayar">
                <div class="modal-body">
                    <h4 class="text-center mt-2 mb-4"> Total Bayar : Rp.0 </h4>
                    <div class="form-row">
                        <div class="col">
                            <label>Jumlah Uang</label>
                            <input type="hidden" name="id">
                            <input type="hidden" name="total">
                            <input type="text" name="jml_uang" class="form-control" placeholder="Jumlah Uang" required>
                        </div>
                        <div class="col">
                            <label>Kembalian</label>
                            <input type="text" name="kembalian" class="form-control" placeholder="Kembalian" value="0" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block">Transaksi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../template/admin_footer.php'; ?>