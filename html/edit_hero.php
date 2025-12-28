<?php
session_start();
include "db/koneksi.php";

// Pastikan hanya admin yang bisa masuk
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Ambil ID dari link yang diklik di dashboard
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM hero WHERE hero_id = '$id'");
$data = mysqli_fetch_assoc($query);

// Jika ID tidak ada di database
if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='dashboard-admin.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Hero - Admin</title>
    <link rel="stylesheet" href="../css/hasil.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="admin-container">
        <h1>Edit Data Hero</h1>
        
        <div class="form-box">
            <form action="admin_action.php" method="POST">
                <input type="hidden" name="proses" value="edit">
                <input type="hidden" name="hero_id" value="<?= $data['hero_id']; ?>">

                <div class="form-group">
                    <label>Nama Hero</label>
                    <input type="text" name="nama_hero" class="input-control" value="<?= $data['name']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Nama File Gambar (di assets/hero/)</label>
                    <input type="text" name="gambar_hero" class="input-control" value="<?= $data['image']; ?>" required>
                </div>
                
                <button type="submit" class="btn btn-save">Simpan Perubahan</button>
                <a href="dashboard-admin.php" class="btn" style="background: #555; color: white;">Batal</a>
            </form>
        </div>
    </div>
</body>
</html>