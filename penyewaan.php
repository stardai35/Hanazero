<?php 
    include './koneksi/koneksi.php'; 
    include './koneksi/function.php'; 
    include './template/header.php'; 
    
    if (empty($_SESSION['id']) || $_SESSION['role'] !=='penyewa') {
        echo "<script>alert('Silahkan login terlebih dahulu!');window.location='login.php'</script>";
        die;
    }
    include './template/nav.php';
    $id_sewa=$conn->query("SELECT MAX(id_sewa) FROM 18073_penyewaan WHERE id_user='".$_SESSION['id']."'")->fetch_row()[0];
?>

<div class="container table-sewa">
    <div class="row mt-5">
        <div class="col rounded shadow p-sm-4">
            <div class="row mb-sm-3">
                <div class="col">
                    <h4>Penyewaan</h4>
                    <small class="font-weight-light">Daftar kostum yang akan/sedang anda sewa.</small>
                </div>
                <div class="col">
                    <h6 class="text-right"><?= (@$id_sewa) ? 'ID Sewa : '.$id_sewa : '' ?></h6>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Gambar</th>
                        <th scope="col">Nama Karakter</th>
                        <th scope="col">Harga Sewa</th>
                        <th scope="col" class="text-center">Jumlah Sewa</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Sub Total</th>
                        <th scope="col">Aksi</th>
                    </tr>
                <tbody>
                    <?php
                    $total=0;
                    $result = $conn->query("SELECT a.*, b.id_alat, b.jumlah, b.keterangan, c.nama, c.harga_sewa, c.gambar , (c.harga_sewa*b.jumlah) sub_total FROM 18073_penyewaan a, 18073_d_sewa b, 18073_alat c WHERE a.id_sewa=b.id_sewa AND b.id_alat=c.id_alat AND a.id_sewa='$id_sewa' AND a.status IN ('temp', 'pre-sewa', 'disewa')") or die($conn->error);
                    if ($result->num_rows > 0):       
                    while($row = $result->fetch_assoc()) 
                    {
                ?>
                    <tr>
                        <td><img src="./assets/img/<?= $row['gambar'] ?>" alt=".."></td>
                        <td><?= $row['nama'] ?></td>
                        <td>Rp.<?= number_format($row['harga_sewa']) ?></td>
                        <td class="text-center">
                            <span class="mx-1 badge badge-info p-2"><?= $row['jumlah'] ?></span>
                        </td>
                        <td><?= $row['keterangan'] ?></td>
                        <td>Rp.<?= number_format($row['sub_total']) ?></td>
                        <td>
                            <?= ($row['status']=='temp') ? "<a href='?act=hapus&id=$row[id_alat]'><button
                                    class='btn btn-outline-danger'>Hapus</button></a>" : '' ?>
                        </td>
                    </tr>
                    <?php
                        $total+=$row['sub_total'];
                        $tgl_sewa=$row['tgl_sewa'];
                        $tgl_kembali=$row['tgl_kembali'];
                        $lama=$row['lama_sewa'];
                        $uang_muka=$row['uang_muka'];
                        $status=$row['status'];
                    }
                    $denda=denda($tgl_kembali, $total);
                    $total_bayar=totalBayar($total*$lama, $denda, $uang_muka);

                ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" class="text-right">&nbsp</th>
                        <th colspan="2" class="text-left">Rp.<?= number_format($total). ' x ' .$lama. ' Hari' ?></th>
                    <tr>
                    <tr>
                        <th colspan="5" class="text-right">Total</th>
                        <th colspan="2" class="text-left">Rp.<?= number_format($total*$lama) ?></th>
                    <tr>
                        <?php if ($status == 'disewa'){ ?>
                    <tr>
                        <th colspan="5" class="text-right">Denda</th>
                        <th colspan="2" class="text-left">Rp.<?= number_format($denda) ?></th>
                    <tr>
                    <tr>
                        <th colspan="5" class="text-right">Uang Muka</th>
                        <th colspan="2" class="text-left">Rp.<?= number_format($uang_muka) ?></th>
                    <tr>
                    <tr>
                        <th colspan="5" class="text-right">Total Bayar</th>
                        <th colspan="2" class="text-left">Rp.<?= number_format($total_bayar) ?></th>
                    <tr>
                        <?php } ?>
                </tfoot>
            </table>
            <hr />

            <?php if ($status == 'temp') { ?>
            <form method="post" action="?act=simpan">
                <div class="form-row justify-content-center mt-2">
                    <div class="col-4">
                        <label>Tanggal Menyewa</label>
                        <input type="datetime-local" name="tgl_sewa" class="form-control" placeholder="Tanggal Menyewa" required>
                    </div>
                    <div class="col-2">
                        <label>Lama Penyewaan</label>
                        <input type="number" name="lama" class="form-control d-inline" placeholder="[Berapa Hari]" required>
                    </div>
                    <div class="col-3 text-center" style="line-height:6.2">
                        <button class="btn btn-outline-primary">Sewa Sekarang</button>
                    </div>
                </div>
            </form>

            <?php } else { ?>

            <div class="form-row justify-content-center mt-2">
                <div class="col-3">
                    <label>Tanggal Menyewa</label>
                    <h5><?= $tgl_sewa ?></h5>
                </div>
                <div class="col-2">
                    <label>Lama Penyewaan</label>
                    <h5><?= $lama ?> Hari</h5>
                </div>
                <div class="col-3">
                    <label>Tanggal Pengembalian</label>
                    <h5><?= $tgl_kembali ?></h5>
                </div>
                <div class="col-2 text-right" style="line-height:6.2">
                    <a href="?act=batal"><button class="btn btn-warning">Batalkan</button></a>
                </div>
            </div>
            <?php 
                }
            else: echo "<tr><td colspan='7'>tidak ada alat yang dipilih!</td></td></tbody></table>";
            endif;
            ?>
            <div class="mt-4">
                <small class="d-block font-weight-light">* Anda harus datang ke tempat kami untuk mengambil 
                    kostum,
                    pada tanggal menyewa yang anda tentukan.</small>
                <small class="d-block font-weight-light">* Kostum yang disewa harus dikembalikan dalam keadaan seperti semula.
                    apabila didapati kerusakan, maka kostum harus diganti berdasarkan kerusakannya </small>
                <small class="d-block font-weight-light">* Kostum harus dikembalikan setelah mencapai lama
                    peminjaman, pada jam seperti waktu pengambilan kostum.. </small>
                <small class="d-block font-weight-light">* Jika Terlambat, denda akan dihitung perjam sebesar total * 4.1666%, dimana
                    ketika sampai 24 seperti menyewa 1 hari </small>
            </div>
        </div>
    </div>
</div>

<?php 
    
    include './template/footer.php';

    if ($_GET){
        $act=@$_GET['act'];
        if ($act=='hapus') {
            $id=@$_GET['id'];
            $query=$conn->query("UPDATE 18073_alat SET jumlah=jumlah+(SELECT jumlah FROM 18073_d_sewa WHERE id_alat='$id' AND id_sewa='$id_sewa') WHERE id_alat='$id'") or die($conn->error);
            $conn->query("DELETE FROM 18073_d_sewa WHERE id_alat='$id' AND id_sewa='$id_sewa'") or die($conn->error);
            echo "<script>window.location='penyewaan.php'</script>";
        }
        elseif ($act=='simpan') {
            $tgl_sewa=$_POST['tgl_sewa'];
            $lama=$_POST['lama'];
            $tgl_kembali=date('Y-m-d H:i:s', strtotime($tgl_sewa . " + $lama day"));
            $conn->query("UPDATE 18073_penyewaan SET tgl_sewa='$tgl_sewa', lama_sewa='$lama', tgl_kembali='$tgl_kembali', biaya_sewa=($total*$lama), status='pre-sewa' WHERE id_sewa='$id_sewa'") or die($conn->error);
            echo "<script>alert('pre-penyewaan berhasil dilakukan!');window.location='penyewaan.php'</script>";
        }
        elseif ($act=='batal') {
            $conn->query("UPDATE 18073_penyewaan SET status='temp' WHERE id_sewa='$id_sewa'");
            echo "<script>window.location='penyewaan.php'</script>";
        }
    }

?>