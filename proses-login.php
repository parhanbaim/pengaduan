<?php

$nik        = $_POST['nik'];
$password   = $_POST['password'];

include 'koneksi.php';
$sql    = "SELECT * FROM masyarakat WHERE nik='$nik' AND password='$password'";
$query  = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($query) > 0) {
    session_start();
    $_SESSION['nik'] = $nik;
    $data = mysqli_fetch_array($query);
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['username'] = $data['username'];

    header("Location: masyarakat.php");
} else {
    echo "<script>alert('Login Gagal, pastikan NIK dan Password benar!');window.location.assign='index.php';</script>";
}