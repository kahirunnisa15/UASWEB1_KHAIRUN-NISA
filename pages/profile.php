<?php
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}

$email = $_SESSION['email'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$user  = mysqli_fetch_assoc($query);

// Avatar fallback (inisial)
$initial = strtoupper(substr($user['name'], 0, 1));
$photo   = !empty($user['photo']) ? "uploads/".$user['photo'] : null;
?>

<style>
.profile-card {
    max-width: 700px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,.08);
    padding: 30px;
}

.profile-header {
    display: flex;
    align-items: center;
    gap: 25px;
    margin-bottom: 30px;
}

.avatar {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    background: #3498db;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 42px;
    color: white;
    font-weight: bold;
    overflow: hidden;
}

.avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.profile-info h2 {
    margin: 0;
}

.profile-info p {
    margin: 5px 0;
    color: #666;
}

.profile-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.profile-table td {
    padding: 12px;
    border-bottom: 1px solid #eee;
}

.profile-table td:first-child {
    width: 150px;
    font-weight: bold;
    color: #555;
}
</style>

<div class="profile-card">
    <div class="profile-header">
        <div class="avatar">
            <?php if ($photo): ?>
                <img src="<?= $photo ?>" alt="Foto Profil">
            <?php else: ?>
                <?= $initial ?>
            <?php endif; ?>
        </div>

        <div class="profile-info">
            <h2><?= htmlspecialchars($user['name']) ?></h2>
            <p><?= htmlspecialchars($user['email']) ?></p>
            <small>Customer POLGANMART</small>
        </div>
    </div>

    <table class="profile-table">
        <tr>
            <td>Nama Lengkap</td>
            <td><?= htmlspecialchars($user['name']) ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?= htmlspecialchars($user['email']) ?></td>
        </tr>
    </table>
</div>
