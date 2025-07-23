<?php
include 'db.php';
$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $conn->query("UPDATE usaha SET name='$name', email='$email' WHERE id=$id");
    header('Location: index.php');
    exit;
}
$user = $conn->query("SELECT * FROM usaha WHERE id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form method="post">
        Nama: <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required><br><br>
        Email: <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br><br>
        <button type="submit">Update</button>
    </form> 
    <br>
    <a href="index.php">Kembali</a>
</body>
</html> 