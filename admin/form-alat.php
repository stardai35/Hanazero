<?php 
    include '../koneksi/koneksi.php'; 
    include '../template/admin_header.php'; 

$id='';
if ($_GET){
  $id=$_GET['id'];
  $data = $conn->query("SELECT * FROM 18073_alat where id_alat='$id'")->fetch_row();
  $nama = $conn->query("SELECT gambar from 18073_alat where id_alat='$id'")->fetch_row()[0];
}
else {
  $nama = 'default.png';
}

if ($_POST) {
  $error='';
  $nama_alat=$_POST['nama'];
  $harga_sewa=$_POST['harga_sewa'];
  $jumlah=$_POST['jumlah'];
  $keterangan=$_POST['keterangan'];


  if ($_FILES['gambar']['error'] !== 4) {

    $nama = $_FILES['gambar']['name'];
    $ukuran	= $_FILES['gambar']['size'];
    $file_tmp = $_FILES['gambar']['tmp_name'];
    $x = explode('.', $nama);
    $ekstensi = strtolower(end($x));
    $ekstensi_diperbolehkan	= array('png','jpg','jpeg');
  
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
        if($ukuran < 1044070){			
            if ($id) {
                $nm_gambar='../assets/img/'.$nama;
                if (file_exists($nm_gambar) && $nama !== 'default.png') {
                    unlink($nm_gambar);
                }
            }
            $nm_gambar="../assets/img/".$nama;
            move_uploaded_file($file_tmp, $nm_gambar);
        }
        else {
            $error='UKURAN FILE TERLALU BESAR!';
        }
    }
    else{
        $error='EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN!';
    }
  }

  if (!$error) {
    if (!$id) {
      $exec = $conn->query("INSERT INTO 18073_alat VALUES (null, '$nama_alat', '$jumlah', '$harga_sewa', '$nama', '$keterangan')") or die($conn->error);
      echo "<script>alert('kostum berhasil ditambahkan');window.location='./data-alat.php'</script>";
    }
    else {
      $exec = $conn->query("UPDATE 18073_alat SET nama='$nama_alat', jumlah='$jumlah', harga_sewa='$harga_sewa', gambar='$nama', keterangan='$keterangan' where id_alat='$id'") or die($conn->error);
      echo "<script>alert('kostum berhasil diubah');window.location='./data-alat.php'</script>";
    }
  }
}

?>

<div class="container">
    <div class="row">
        <div class="col shadow p-sm-5 rounded">
            <div class="row mb-sm-3">
                <div class="col">
                    <h3><?= (@$id) ? 'Edit Kostum' : 'Tambah Kostum' ?></h3>
                </div>
                <div class="col text-right">
                    <a href="data-alat.php"><button class="btn btn-outline-primary">Data Kostum >></button></a>
                </div>
            </div>
            <?= (@$error) ? "<div class='alert alert-danger'>$error</div>" : '' ?>

            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nama Karakter</label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama Karakter" value="<?= @$data[1] ?>"
                        required>
                </div>
                <div class="form-group">
                    <label>Harga Sewa</label>
                    <input type="number" class="form-control" name="harga_sewa" placeholder="Harga Sewa"
                        value="<?= @$data[3] ?>" required>
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="text" class="form-control" name="jumlah" placeholder="Jumlah" value="<?= @$data[2] ?>"
                        required>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" rows="3" name="keterangan"
                        placeholder="Keterangan"><?= @$data[5] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" class="form-control-file" name="gambar">
                </div>
                <button type="submit" class="btn btn-primary">Simpan Kostum</button>
            </form>
        </div>
    </div>
</div>

<?php include '../template/admin_footer.php'; ?>