<?php
session_start();
include "db/koneksi.php";

// Proteksi akses: Hanya admin yang boleh masuk
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$result_hero = mysqli_query($conn, "SELECT * FROM hero ORDER BY hero_id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - MyHERO</title>
    <link rel="stylesheet" href="../css/admin.css"> </head>
<body style="background: #000;">
    <div class="admin-container">
        <div class="admin-header">
            <h1>Dashboard Admin</h1>
            <div class="nav-actions">
                <a href="diagnosa.php" class="btn-back">← KEMBALI KE DIAGNOSA</a>
                <a href="logout.php" class="btn btn-logout">LOGOUT</a>
            </div>
        </div>
        
        <div class="form-box">
            <h3>Tambah Hero Baru</h3>
            <form action="admin_action.php" method="POST">
                <input type="hidden" name="proses" value="tambah">
                <div class="form-group">
                    <label>Nama Hero</label>
                    <input type="text" name="nama_hero" class="input-control" required>
                </div>
                <div class="form-group">
                    <label>Nama File Gambar (di assets/hero/)</label>
                    <input type="text" name="gambar_hero" class="input-control" required>
                </div>
                <button type="submit" class="btn btn-save">Simpan Hero</button>
            </form>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama Hero</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result_hero)): ?>
                <tr>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['image']; ?></td>
                    <td>
                        <a href="edit_hero.php?id=<?= $row['hero_id']; ?>" class="btn btn-edit">Edit</a>
                        <a href="admin_action.php?proses=hapus&id=<?= $row['hero_id']; ?>" 
                           class="btn btn-delete" onclick="return confirm('Hapus hero ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>