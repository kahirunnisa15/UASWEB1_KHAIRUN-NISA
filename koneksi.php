<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "db_penjualann"; // gunakan nama database yang benar

$conn = new mysqli($host, $username, $password, $dbname);

// cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
