<?php
 if(isset($_GET['url'])) {
    $page = $_GET['url'];

switch ($page) {
    case 'dashboard':
        include 'dashboard.php';
        break;

    case 'tulis-pengaduan':
        include 'tulis-pengaduan.php';
        break;
       
    case 'lihat-pengaduan':
        include 'lihat-pengaduan.php';
        break;

    case 'detail-pengaduan':
        include 'detail-pengaduan.php';
        break;
    
    case 'lihat-tanggapan':
        include 'lihat-tanggapan.php';
        break;

    case 'verifikasi_laporan':
    case 'verifikasi':
        include 'verifikasi.php';
        break;

        default:
        echo "halaman tidak ditemukan";
        break;
}
}else {
    echo "Selamat Datang di Aplikasi Pelaporan Pengaduan Masyarakat. Di mana aplikasi ini dibuat untuk melaporkan tindakan yang menyimpang dari ketentuan.<br>";
    echo "Anda login sebagai : " . $_SESSION['nama_petugas'];
    
}
?>
