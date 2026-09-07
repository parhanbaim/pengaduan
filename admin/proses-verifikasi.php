<?php
session_start();
if (($_SESSION['level'] ?? '') !== 'admin') {
    header('Location: ../index2.php');
    exit;
}

include '../koneksi.php';
$id = (int) ($_POST['id_pengaduan'] ?? 0);
if ($id > 0) {
    $stmt = mysqli_prepare($koneksi, "UPDATE pengaduan SET status = 'proses' WHERE id_pengaduan = ? AND status = '0'");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

header('Location: admin.php?url=verifikasi_laporan');
exit;
