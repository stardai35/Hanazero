<?php

if (@$_GET['id']) {
	include '../koneksi/koneksi.php';
      $id=$_GET['id'];
      $nm_gambar = $conn->query("SELECT gambar from 18073_alat where id_alat='$id'")->fetch_row()[0];
      if (file_exists('../assets/img/'.$nm_gambar) && $nm_gambar !== 'default.png') {
          unlink('../assets/img/'.$nm_gambar);
      }
      $exec = $conn->query("DELETE FROM 18073_alat where id_alat='$id'") or die($conn->error);
      if ($exec) {
        echo "<script>alert('peralatan berhasil dihapus');window.location='./data-alat.php'</script>";
      }
    }

?>