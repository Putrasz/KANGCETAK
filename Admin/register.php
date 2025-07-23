<?php
session_start();
include 'db.php';

// Step control
$step = isset($_GET['step']) ? intval($_GET['step']) : 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($step === 1) {
        // Simpan data step 1 ke session
        $_SESSION['reg_nama_usaha'] = $_POST['nama_usaha'];
        $_SESSION['reg_lokasi'] = $_POST['lokasi'];
        $_SESSION['reg_jenis_kertas'] = isset($_POST['jenis_kertas']) ? implode(',', $_POST['jenis_kertas']) : '';
        header('Location: register.php?step=2');
        exit;
    } elseif ($step === 2) {
        // Simpan data step 2 ke session
        $_SESSION['reg_email'] = $_POST['email'];
        // Simpan ke database
        $nama_usaha = mysqli_real_escape_string($conn, $_SESSION['reg_nama_usaha']);
        $lokasi = mysqli_real_escape_string($conn, $_SESSION['reg_lokasi']);
        $jenis_kertas = mysqli_real_escape_string($conn, $_SESSION['reg_jenis_kertas']);
        $email = mysqli_real_escape_string($conn, $_SESSION['reg_email']);
        $sql = "INSERT INTO usaha (nama_usaha, lokasi, jenis_kertas, email, status) VALUES ('$nama_usaha', '$lokasi', '$jenis_kertas', '$email', 'pending')";
        mysqli_query($conn, $sql);
        // Bersihkan session
        unset($_SESSION['reg_nama_usaha'], $_SESSION['reg_lokasi'], $_SESSION['reg_jenis_kertas'], $_SESSION['reg_email']);
        header('Location: register.php?step=3');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register Usaha</title>
    <style>
        body { font-family: Arial, sans-serif; background: #7b263a; color: #222; }
        .container { background: #fff; padding: 2em; margin: 3em auto; width: 350px; border-radius: 8px; box-shadow: 0 0 10px #0002; }
        h2 { text-align: center; }
        label { display: block; margin-top: 1em; }
        input[type=text], input[type=email] { width: 100%; padding: 0.5em; margin-top: 0.3em; border: 1px solid #ccc; border-radius: 4px; }
        .checkbox-group { margin-top: 0.5em; }
        .checkbox-group label { display: inline-block; margin-right: 1em; }
        button { margin-top: 1.5em; width: 100%; padding: 0.7em; background: #7b263a; color: #fff; border: none; border-radius: 4px; font-size: 1em; cursor: pointer; }
        .success { text-align: center; color: #7b263a; }
        .login-link { text-align: center; margin-top: 2em; }
    </style>
</head>
<body>
<div class="container">
<?php if ($step === 1): ?>
    <h2>Daftar Usaha - Step 1</h2>
    <form method="POST" action="register.php?step=1">
        <label>Nama Usaha
            <input type="text" name="nama_usaha" required>
        </label>
        <label>Lokasi Usaha
            <input type="text" name="lokasi" required>
        </label>
        <label>Jenis Kertas yang Bisa di Print:</label>
        <div class="checkbox-group">
            <label><input type="checkbox" name="jenis_kertas[]" value="HVS"> HVS</label>
            <label><input type="checkbox" name="jenis_kertas[]" value="Art Paper"> Art Paper</label>
            <label><input type="checkbox" name="jenis_kertas[]" value="Duplex"> Duplex</label>
            <label><input type="checkbox" name="jenis_kertas[]" value="Ivory"> Ivory</label>
            <label><input type="checkbox" name="jenis_kertas[]" value="Karton"> Karton</label>
        </div>
        <button type="submit">Lanjut</button>
    </form>
<?php elseif ($step === 2): ?>
    <h2>Daftar Usaha - Step 2</h2>
    <form method="POST" action="register.php?step=2">
        <label>Email
            <input type="email" name="email" required>
        </label>
        <button type="submit">Daftar</button>
    </form>
<?php elseif ($step === 3): ?>
    <div class="success">
        <h2>Pendaftaran Berhasil!</h2>
        <p>Terima kasih telah mendaftar. Silakan tunggu konfirmasi dari admin.</p>
        <div class="login-link">
            <a href="index.php">Ke Halaman Login</a>
        </div>
    </div>
<?php endif; ?>
</div>
</body>
</html> 