<?php

if (@$_POST) {
	include '../koneksi/koneksi.php';
  $id=$_POST['id'];
  $total=$_POST['total'];
  $jml_uang=$_POST['jml_uang'];
  $kembali=$_POST['kembalian'];
  $query=$conn->query("SELECT * FROM 18073_d_sewa WHERE id_sewa='$id'");
  while($row=$query->fetch_assoc()){
    $conn->query("UPDATE 18073_alat SET jumlah=jumlah+$row[jumlah] WHERE id_alat=$row[id_alat]");
  }
  $exec = $conn->query("UPDATE 18073_penyewaan  SET status='selesai' where id_sewa='$id'") or die($conn->error);
  $exec = $conn->query("INSERT INTO 18073_pembayaran VALUES(null, '$id', now(), '$jml_uang', '$total', '$kembali')") or die($conn->error);
  if ($exec) {
    echo "<script>alert('transaksi pembayaran berhasil dilakukan');window.location='./disewa.php'</script>";
  }
}

?>