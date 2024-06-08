<?php 
    include '../koneksi/koneksi.php'; 
    include '../template/admin_header.php'; 
?>

<div class="container">
    <div class="row">
        <div class="col shadow p-sm-5 rounded">
            <div class="row mb-sm-3">
                <div class="col">
                    <h3>Daftar pre-Sewa</h3>
                </div>
            </div>
            <table id="tabel" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID Sewa</th>
                        <th scope="col">Penyewa</th>
                        <th scope="col">Tanggal Sewa</th>
                        <th scope="col">Lama Sewa</th>
                        <th scope="col">Biaya Sewa</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no=0;
                    $result = $conn->query("SELECT a.*, b.nama FROM 18073_penyewaan a, 18073_user b where a.id_user=b.id_user AND status='pre-sewa'") or die($conn->error);
                    if ($result->num_rows > 0) {       
                        while($row = $result->fetch_assoc()) 
                        {
                    ?>
                    <tr>
                        <td><?= $row['id_sewa'] ?></td>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['tgl_sewa'] ?></td>
                        <td><?= $row['lama_sewa'] ?> Hari</td>
                        <td>Rp.<?= number_format($row['biaya_sewa']) ?></td>
                        <td><?= $row['keterangan'] ?></td>
                        <td class="text-center">
                            <button class="btn btn-warning" data-toggle="modal" data-target="#konfirmasi"
                                data-id="<?= $row['id_sewa'] ?>">Konfirmasi</button>
                            <a href="detail.php?id=<?= $row['id_sewa'] ?>"><button
                                    class="btn btn-outline-primary">Detail</button></a>
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
<div class="modal fade" id="konfirmasi" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penyewaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="konfirm-sewa.php" method="post">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col">
                            <label class="col-form-label">Uang Muka:</label>
                            <input type="hidden" name="id">
                            <input type="text" name="uangmuka" class="form-control" placeholder="Uang Muka" required>
                        </div>
                        <div class="col">
                            <label class="col-form-label">Jaminan:</label>
                            <input type="text" name="jaminan" class="form-control" placeholder="Jaminan" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Keterangan:</label>
                        <textarea class="form-control" name="keterangan" placeholder="Keterangan"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../template/admin_footer.php'; ?>