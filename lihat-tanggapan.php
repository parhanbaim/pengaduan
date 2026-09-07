<?php

$id = (int) ($_GET['id'] ?? 0);
if(empty($id)) {
    header("location: masyarakat.php?url=lihat-pengaduan");
    exit;
}

include 'koneksi.php';
$query = mysqli_query($koneksi, "SELECT p.tgl_pengaduan, p.isi_laporan, p.foto, t.tgl_tanggapan, t.tanggapan
    FROM pengaduan AS p
    INNER JOIN tanggapan AS t ON t.id_pengaduan = p.id_pengaduan
    WHERE p.id_pengaduan = $id
    ORDER BY t.tgl_tanggapan DESC");

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
            <?php
            if(mysqli_num_rows($query) == 0){
                echo "<div class='alert alert-danger'>Maaf tanggapan anda belum ditanggapi.</div>";
            }else{
            while($data = mysqli_fetch_assoc($query)){ ?>
        

    <div class="border-bottom mb-4 pb-3">
        <div class="form-group">
            <label style="font-size: 14px;">Tgl pengaduan</label>
            <input type="date" class="form-control" readonly value="<?= htmlspecialchars($data['tgl_pengaduan']) ?>">
        </div>

    <div class="form-group">
        <label style="font-size: 14px;">isi laporan</label>
        <textarea class="form-control" readonly><?= htmlspecialchars($data['isi_laporan']) ?></textarea>
    </div>

    <div class="form-group">
        <label style="font-size: 14px;">foto</label>
        <img class="img-thumbnail" src="foto/<?= htmlspecialchars($data['foto']) ?>" width="300">
    </div>

    <div class="form-group mb-0">
        <label style="font-size: 14px;">Tanggapan petugas</label>
        <input type="date" class="form-control mb-2" readonly value="<?= htmlspecialchars($data['tgl_tanggapan']) ?>">
        <textarea class="form-control" readonly><?= htmlspecialchars($data['tanggapan']) ?></textarea>
    </div>
    </div>
    <?php } ?>
    <?php } ?>
</div>
</div>