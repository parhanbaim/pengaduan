<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


session_start();
$tgl_pengaduan    = $_POST['tgl_pengaduan'];
$nik              = $_SESSION['nik'];
$isi_laporan      = $_POST['isi_laporan'];
$lokasi_foto      = $_FILES['foto']['tmp_name'];
$nama_foto        = $_FILES['foto']['name'];
$status           = '0';

if(move_uploaded_file($lokasi_foto, 'foto/'.$nama_foto)) {
    $sql = "INSERT INTO pengaduan (tgl_pengaduan, nik, isi_laporan, foto, status) VALUES ('$tgl_pengaduan', '$nik', '$isi_laporan', '$nama_foto', '$status')";
    
   
    include 'koneksi.php';
    if(mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Pengaduan berhasil disimpan!');
        window.location.assign('masyarakat.php?url=tulis-pengaduan');</script>";
    } else {
        echo "<script>alert('Gagal menyimpan pengaduan!');
        window.location.assign('masyarakat.php?url=tulis-pengaduan');</script>";
    }
}