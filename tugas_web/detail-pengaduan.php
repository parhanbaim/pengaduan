<?php

$id = $_GET['id'];
if(empty($id)) {
    header("location: masyarakat.php?url=lihat-pengaduan");
}

include 'koneksi.php';
$query = mysqli_query($koneksi, "SELECT * FROM pengaduan WHERE id_pengaduan='$id'");
$data = mysqli_fetch_array($query);

?>

<div class="card shadow">
<div class="card-header">
    <a href="?url=lihat-pengaduan" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-5">
            <i class="fa fa-arrow-left"></i>
        </span>
        <span class="text"> Kembali </span>
    </a>
</div>
<div class="card-body">

    <form method="POST" action="proses-pengaduan.php" enctype="multipart/form-data">
        
        <div class="form-group">
            <label style="font-size: 14px;">Tgl pengaduan</label>
            <input type="date" name="Tgl_pengaduan" class="form-control" readonly value="<?= $data['tgl_pengaduan'] ?>">
        </div>

    <div class="form-group">
        <label style="font-size: 14px;">isi laporan</label>
        <textarea name="isi_laporan" class="form-control" required><?= $data['isi_laporan'] ?></textarea>
    </div>

    <div class="form-group">
        <label style="font-size: 14px;">foto</label>
        <img class="img-thumbnail" src="foto/<?= $data['foto'] ?>" width="300">
    </div>
    
    </form>
</div>
</div>