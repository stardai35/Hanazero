<?php

if (@$_GET['id']) {
	include '../koneksi/koneksi.php';
      $id=$_GET['id'];
      $exec = $conn->query("DELETE FROM 18073_user where id_user='$id'") or die($conn->error);
      if ($exec) {
        echo "<script>alert('pengguna berhasil dihapus');window.location='./data-user.php'</script>";
      }
    }

?>