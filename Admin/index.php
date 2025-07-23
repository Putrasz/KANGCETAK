<?php
session_start();
include 'db.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $sql = "SELECT * FROM usaha WHERE email='$email' AND password='$password' AND status='active'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 1) {
        $_SESSION['admin_email'] = $email;
        header('Location: admin.php');
        exit;
    } else {
        $error = 'Email atau password salah, atau akun belum aktif.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <style>
        body { font-family: Arial, sans-serif; background: #7b263a; color: #222; }
        .container { background: #fff; padding: 2em; margin: 3em auto; width: 350px; border-radius: 8px; box-shadow: 0 0 10px #0002; }
        h2 { text-align: center; }
        label { display: block; margin-top: 1em; }
        input[type=email], input[type=password] { width: 100%; padding: 0.5em; margin-top: 0.3em; border: 1px solid #ccc; border-radius: 4px; }
        button { margin-top: 1.5em; width: 100%; padding: 0.7em; background: #7b263a; color: #fff; border: none; border-radius: 4px; font-size: 1em; cursor: pointer; }
        .error { color: #b00; text-align: center; margin-top: 1em; }
    </style>
</head>
<body>
<div class="container">
    <h2>Login Admin</h2>
    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <label>Email
            <input type="email" name="email" required>
        </label>
        <label>Password
            <input type="password" name="password" required>
        </label>
        <button type="submit">Login</button>
    </form>
</div>
</body>
</html> 