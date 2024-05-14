<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "my_campus";

// Membuat koneksi
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Memeriksa koneksi
if (mysqli_connect_errno()) {
    // Jika koneksi gagal, tampilkan pesan kesalahan yang lebih spesifik
    die("Koneksi dengan database gagal: " . mysqli_connect_errno() . " - " . mysqli_connect_error());
}
?>
