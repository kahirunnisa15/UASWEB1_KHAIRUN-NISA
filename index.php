<?php
session_start();
include 'koneksi.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email    = $_POST['email'];
    $password = $_POST['password'];

    $query  = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user   = mysqli_fetch_assoc($query);

    if ($user) {
        if ($password === $user['password']) {

            $_SESSION['email'] = $user['email'];
            $_SESSION['name']  = $user['name'];
            $_SESSION['role']  = $user['role'];

            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Password yang Anda masukkan salah.";
        }
    } else {
        $error = "Email belum terdaftar.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login | POLGAN MART</title>

<style>
:root {
    --primary: #2563eb;
    --secondary: #38bdf8;
    --accent: #facc15;
    --dark: #020617;
    --glass: rgba(255,255,255,.15);
}

/* RESET */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', system-ui, sans-serif;
}

/* BACKGROUND */
body {
    min-height: 100vh;
    background:
        radial-gradient(circle at 10% 20%, #38bdf8, transparent 40%),
        radial-gradient(circle at 90% 80%, #facc15, transparent 40%),
        linear-gradient(135deg, #020617, #0f172a);
    display: flex;
    justify-content: center;
    align-items: center;
}

/* CARD */
.login-container {
    width: 420px;
    padding: 40px;
    border-radius: 22px;
    background: var(--glass);
    backdrop-filter: blur(16px);
    box-shadow: 0 30px 80px rgba(0,0,0,.45);
    color: #fff;
    animation: floatIn .8s ease;
}

@keyframes floatIn {
    from {opacity:0; transform: translateY(30px);}
    to {opacity:1; transform: translateY(0);}
}

/* TITLE */
.login-container h2 {
    text-align: center;
    font-size: 28px;
    margin-bottom: 6px;
    background: linear-gradient(to right, #38bdf8, #facc15);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.login-container p {
    text-align: center;
    color: #e5e7eb;
    margin-bottom: 30px;
    font-size: 14px;
}

/* FORM */
.form-group {
    margin-bottom: 18px;
}

.form-group label {
    display: block;
    font-size: 13px;
    margin-bottom: 6px;
    color: #e5e7eb;
}

.form-group input {
    width: 100%;
    padding: 13px;
    border-radius: 12px;
    border: 1px solid rgba(255,255,255,.25);
    background: rgba(255,255,255,.1);
    color: #fff;
    outline: none;
    transition: .3s;
}

.form-group input::placeholder {
    color: #cbd5f5;
}

.form-group input:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 2px rgba(250,204,21,.25);
}

/* BUTTON */
.btn-login {
    width: 100%;
    padding: 14px;
    margin-top: 10px;
    border-radius: 14px;
    border: none;
    background: linear-gradient(to right, #2563eb, #38bdf8);
    color: #fff;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: .4s;
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 35px rgba(37,99,235,.45);
}

/* RESET */
.btn-reset {
    width: 100%;
    padding: 12px;
    margin-top: 12px;
    border-radius: 14px;
    border: none;
    background: linear-gradient(to right, #facc15, #fde047);
    font-weight: 700;
    cursor: pointer;
}

.btn-reset:hover {
    box-shadow: 0 10px 25px rgba(250,204,21,.45);
}

/* ERROR */
.alert {
    background: rgba(239,68,68,.25);
    color: #fecaca;
    padding: 12px;
    border-radius: 12px;
    text-align: center;
    margin-bottom: 18px;
    font-size: 14px;
}

/* FOOTER */
.footer {
    text-align: center;
    margin-top: 20px;
    font-size: 12px;
    color: #cbd5f5;
}
</style>
</head>

<body>

<div class="login-container">
    <h2>POLGAN MART</h2>
    <p>Silakan login untuk melanjutkan</p>

    <?php if ($error != "") { ?>
        <div class="alert"><?= $error; ?></div>
    <?php } ?>

    <form method="post">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="example@gmail.com" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn-login">LOGIN</button>
        <button type="reset" class="btn-reset">BATAL</button>
    </form>

    <div class="footer">
        © 2026 POLGAN MART
    </div>
</div>

</body>
</html>
