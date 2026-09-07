<?php

session_start();
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

include 'koneksi.php';
$username = mysqli_real_escape_string($koneksi, $username);
$password = mysqli_real_escape_string($koneksi, $password);
$sql = "SELECT * FROM petugas WHERE username='$username' AND passsword='$password'";
$query = mysqli_query($koneksi, $sql);

if (!$query) {
    exit('Login gagal: ' . mysqli_error($koneksi));
}

if (mysqli_num_rows($query) > 0) {
    $data = mysqli_fetch_array($query);
    $_SESSION['id_petugas'] = $data['id_petugas'];
    $_SESSION['nama_petugas'] = $data['nama_petugas'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['level'] = $data['level'];
    if($data['level'] == 'admin') {
        header("Location: admin/admin.php");
        exit;
    } else if($data['level'] == 'petugas') {
        header("Location: petugas/petugas.php");
        exit;
    } else {
        header("Location: index2.php");
        exit;
    }
} else {
    echo "<script>alert('Login gagal, pastikan username dan password benar!');window.location.assign('index2.php');</script>";
}
