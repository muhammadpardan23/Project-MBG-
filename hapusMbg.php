<?php
include 'koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Langsung hapus data dari tabel tb_siswa berdasarkan id_siswa
$stmt = mysqli_prepare($koneksi, "DELETE FROM tb_menu_mbg WHERE id_menu = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);

if (mysqli_stmt_execute($stmt)) {
    header("Location: menuMbg.php?pesan=sukses");
    exit();
} else {
    header("Location: menuMbg.php?pesan=gagal");
    exit();
}
?>
