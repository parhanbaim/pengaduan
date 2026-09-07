<?php
session_start();
if (($_SESSION['level'] ?? '') !== 'petugas') {
    header('Location: ../index2.php');
    exit;
}

include '../koneksi.php';
$id_pengaduan = (int) ($_POST['id_pengaduan'] ?? 0);
$tanggapan = trim($_POST['tanggapan'] ?? '');
$id_petugas = (int) ($_SESSION['id_petugas'] ?? 0);

if ($id_pengaduan > 0 && $tanggapan !== '' && $id_petugas > 0) {
    mysqli_begin_transaction($koneksi);
    $tanggal = date('Y-m-d');
    $stmt = mysqli_prepare($koneksi, "INSERT INTO tanggapan (id_pengaduan, tgl_tanggapan, tanggapan, id_petugas) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'issi', $id_pengaduan, $tanggal, $tanggapan, $id_petugas);
    $berhasil = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($berhasil) {
        $stmt = mysqli_prepare($koneksi, "UPDATE pengaduan SET status = 'selesai' WHERE id_pengaduan = ? AND status = 'proses'");
        mysqli_stmt_bind_param($stmt, 'i', $id_pengaduan);
        $berhasil = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    if ($berhasil) {
        mysqli_commit($koneksi);
    } else {
        mysqli_rollback($koneksi);
    }
}

header('Location: petugas.php?url=tanggapi_laporan');
exit;
