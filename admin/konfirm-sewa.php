<?php

if (@$_POST) {
	include '../koneksi/koneksi.php';
  $id=$_POST['id'];
  $uang_muka=$_POST['uangmuka'];
  $jaminan=$_POST['jaminan'];
  $keterangan=$_POST['keterangan'];
  $exec = $conn->query("UPDATE 18073_penyewaan  SET jaminan='$jaminan', keterangan='$keterangan', uang_muka='$uang_muka', status='disewa' where id_sewa='$id'") or die($conn->error);
  if ($exec) {
    echo "<script>alert('penyewaan berhasil dilakukan');window.location='./disewa.php'</script>";
  }
}

?>