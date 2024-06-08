<?php
    include '../koneksi/koneksi.php';
    $tgl_awal=@$_GET['awal'];
    $tgl_akhir=@$_GET['akhir'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="reporting">
    <h2>Laporan Transaksi Penyewaan Kostum<br>
        HANAZERO COSTUME</h2>
    <h4><b>Periode <?= $tgl_awal. ' Sampai '. $tgl_akhir ?></b></h4>
    <table class="table gtable-striped table-bordered mt-4">
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
                $sql = "SELECT a.lama_sewa, d.id_bayar, e.nama penyewa, d.tgl_bayar, c.nama, b.jumlah, c.harga_sewa, (c.harga_sewa*b.jumlah*a.lama_sewa) sub_total FROM 18073_penyewaan a, 18073_d_sewa b, 18073_alat c, 18073_pembayaran d, 18073_user e  where d.id_sewa=a.id_sewa AND b.id_sewa=a.id_sewa AND b.id_alat=c.id_alat AND a.id_user=e.id_user AND tgl_bayar BETWEEN '$tgl_awal' and '$tgl_akhir'";
                $result = $conn->query($sql) or die($conn->error);
                if ($result->num_rows > 0) {       
                    while($row = $result->fetch_assoc()) 
                    {
                ?>
            <tr>
                <td><?= ++$no ?></td>
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

    <script>
        window.print();
    </script>

</body>
</html>