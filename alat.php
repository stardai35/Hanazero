<?php 
    include './koneksi/koneksi.php'; 
    include './template/header.php'; 
    include './template/nav.php'; 
?>

<div class="container table-alat">
    <div class="row mt-5">
        <div class="col p-sm-4">
            <div class="row mb-sm-3">
                <div class="col">
                    <h4>Daftar Kostum Karakter</h4>
                    <small class="font-weight-light">Silahkan pilih kostum yang akan kamu sewa.</small>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Gambar</th>
                        <th scope="col">Nama Karakter</th>
                        <th scope="col">Harga Sewa</th>
                        <th scope="col">Status Ketersediaan</th>
                        <th scope="col">Sewa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM 18073_alat") or die($conn->error);
                    if ($result->num_rows > 0) {       
                    while($row = $result->fetch_assoc()) 
                    {
                ?>
                    <tr>
                        <th scope="row"><img src="assets/img/<?= $row['gambar'] ?>" alt=".."></th>
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
                        <td><button data-toggle="modal" data-target="#sewa" data-id="<?= $row['id_alat'] ?>"
                                class="btn btn-primary">Sewa</button>
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
<div class="modal fade" id="sewa" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sewa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="act-sewa.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Status Penyewaan:</label>
                        <input type="hidden" name="id">
                        <input type="number" name="jumlah" class="form-control" placeholder="Jumlah Penyewaan" required>
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

<?php include './template/footer.php'; ?>