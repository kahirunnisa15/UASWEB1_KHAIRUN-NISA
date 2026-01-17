<?php
session_start();
include __DIR__ . '/koneksi.php';

// CEK LOGIN
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard POLGANMART</title>
<style>
body {
    margin: 0;
    font-family: Arial;
    background: #f4f4f4;
}

/* Sidebar */
.sidebar {
    width: 220px;
    height: 100vh;
    background: #2c3e50;
    color: white;
    position: fixed;
    top: 0;
    left: 0;
}

.sidebar h2 {
    text-align: center;
    padding: 20px 0;
    border-bottom: 1px solid rgba(255,255,255,.2);
}

.sidebar a {
    display: block;
    color: white;
    padding: 12px 20px;
    text-decoration: none;
}

.sidebar a:hover {
    background: #34495e;
}

/* Header */
.header {
    height: 60px;
    background: white;
    padding: 10px 20px;
    margin-left: 220px;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    border-bottom: 1px solid #ddd;
}

.profile-btn {
    cursor: pointer;
    padding: 8px 15px;
    border-radius: 20px;
    background: #3498db;
    color: white;
}

/* Dropdown */
.dropdown {
    position: relative;
}

.dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    background: white;
    min-width: 150px;
    box-shadow: 0 2px 8px rgba(0,0,0,.2);
    border-radius: 5px;
}

.dropdown-content a {
    display: block;
    padding: 10px;
    text-decoration: none;
    color: #333;
}

.dropdown-content a:hover {
    background: #f0f0f0;
}

/* Content */
.content {
    margin-left: 220px;
    padding: 20px;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Dashboard</h2>
    <a href="dashboard.php?page=home">Home</a>
    <a href="dashboard.php?page=listproducts">List Produk</a>
    <a href="dashboard.php?page=profile">Customer</a>
    <a href="dashboard.php?page=transaksi">Transaksi</a>
    <a href="dashboard.php?page=laporan">Laporan</a>
</div>

<!-- HEADER -->
<div class="header">
    <div class="dropdown">
        <div class="profile-btn" onclick="toggleMenu()">Profile ▾</div>
        <div class="dropdown-content" id="profileMenu">
            <a href="dashboard.php?page=profile">My Profile</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</div>

<!-- CONTENT -->
<div class="content">
<?php
$page = $_GET['page'] ?? 'home';

$allowed_pages = [
    'home',
    'listproducts',
    'profile',
    'transaksi',
    'laporan'
];

$file = __DIR__ . "/pages/$page.php";

if (in_array($page, $allowed_pages) && file_exists($file)) {
    include $file;
} else {
    echo "<h2>Welcome Dashboard</h2>";
}
?>
</div>

<script>
function toggleMenu() {
    const menu = document.getElementById("profileMenu");
    menu.style.display = menu.style.display === "block" ? "none" : "block";
}

window.onclick = function(e) {
    if (!e.target.closest('.dropdown')) {
        document.getElementById("profileMenu").style.display = "none";
    }
}
</script>

</body>
</html>
