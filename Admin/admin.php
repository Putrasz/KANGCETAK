<?php
session_start();
include 'db.php';

// Cek login
if (!isset($_SESSION['admin_email'])) {
    header('Location: index.php');
    exit;
}

// Proses aktivasi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['password'])) {
    $id = intval($_POST['id']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $sql = "UPDATE usaha SET password='$password', status='active' WHERE id=$id";
    mysqli_query($conn, $sql);
}

// Ambil pendaftar pending
$result = mysqli_query($conn, "SELECT * FROM usaha WHERE status='pending'");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <style>
        body { font-family: Arial, sans-serif; background: #7b263a; color: #222; }
        .container { background: #fff; padding: 2em; margin: 3em auto; width: 700px; border-radius: 8px; box-shadow: 0 0 10px #0002; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 1em; }
        th, td { border: 1px solid #ccc; padding: 0.5em; text-align: left; }
        th { background: #eee; }
        form { display: flex; gap: 0.5em; }
        input[type=password] { padding: 0.3em; border: 1px solid #ccc; border-radius: 4px; }
        button { background: #7b263a; color: #fff; border: none; border-radius: 4px; padding: 0.4em 1em; cursor: pointer; }
    </style>
</head>
<body>
<div class="container">
    <h2>Admin Panel - Aktivasi Pendaftar</h2>
    <table>
        <tr>
            <th>Nama Usaha</th>
            <th>Lokasi</th>
            <th>Jenis Kertas</th>
            <th>Email</th>
            <th>Aktivasi</th>
            <th>DELETE</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= htmlspecialchars($row['nama_usaha']) ?></td>
            <td><?= htmlspecialchars($row['lokasi']) ?></td>
            <td><?= htmlspecialchars($row['jenis_kertas']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td>
                <form method="POST" action="">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit">Aktifkan</button>
                </form>
            </td>
            <td><?= htmlspecialchars($row['email']) ?><button><a href="delete.php"></a></button></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html> 