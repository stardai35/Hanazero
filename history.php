<?php 
    include './koneksi/koneksi.php'; 
    include './koneksi/function.php'; 
    include './template/header.php'; 
    if (empty($_SESSION['id']) || $_SESSION['role'] !=='penyewa') {
        echo "<script>alert('Silahkan login terlebih dahulu!');window.location='login.php'</script>";
        die;
    }
    include './template/nav.php'; 
?>

<div class="container table-history">
    <div class="row mt-5">
        <div class="col rounded shadow p-sm-4">
            <div class="row mb-sm-3">
                <div class="col">
                    <h4>History</h4>
                    <small class="font-weight-light">Daftar penyewaan yang pernah anda lakukan.</small>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID Sewa</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Lama Sewa</th>
                        <th scope="col">Total Sewa</th>
                        <th scope="col">Aksi</th>
                    </tr>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT b.id_sewa, b.lama_sewa, a.tgl_bayar, (a.total_bayar + b.uang_muka) total  FROM 18073_pembayaran a, 18073_penyewaan b WHERE a.id_sewa=b.id_sewa AND b.id_user='".$_SESSION['id']."' ORDER BY a.tgl_bayar ASC ");
                    if ($result->num_rows > 0) {       
                    while($row = $result->fetch_assoc()) 
                    {
                ?>
                    <tr>
                        <th scope="row"><?= $row['id_sewa'] ?></th>
                        <td><?= $row['tgl_bayar'] ?></td>
                        <td><?= $row['lama_sewa'] ?> Hari</td>
                        <td>Rp.<?= number_format($row['total']) ?></td>
                        <td>
                            <a href="detail.php?id=<?= $row['id_sewa'] ?>"><button class="btn btn-outline-success">Detail</button></a>
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

<?php include './template/footer.php'; ?>