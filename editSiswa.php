<?php
include 'koneksi.php';

// Ambil id_siswa dari URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Ambil data siswa berdasarkan id_siswa
$stmt = mysqli_prepare($koneksi, "SELECT * FROM tb_siswa WHERE id_siswa = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$siswa = mysqli_fetch_assoc($result);

if (!$siswa) {
    die("Data siswa tidak ditemukan. Pastikan Anda mengakses halaman ini dari tombol Edit di daftar siswa.");
}

$error = "";

if (isset($_POST['ubah'])) {
    $nis     = trim($_POST['nis']);
    $nama    = trim($_POST['nama']);
    $kelas   = trim($_POST['kelas']);

    if (empty($nis) || empty($nama) || empty($kelas)) {
        $error = "Semua kolom wajib diisi!";
    } else {
        $stmt_update = mysqli_prepare($koneksi, "UPDATE tb_siswa SET nis = ?, nama = ?, kelas = ? WHERE id_siswa = ?");
        mysqli_stmt_bind_param($stmt_update, 'sssi', $nis, $nama, $kelas, $id);
        
        if (mysqli_stmt_execute($stmt_update)) {
            header("Location: tampilSiswa.php");
            exit();
        } else {
            $error = "Gagal memperbarui data siswa!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f5f9;
            margin: 0;
            padding: 30px;
            color: #334155;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        h2 {
            color: #1e293b;
            font-size: 22px;
            margin-bottom: 5px;
        }

        .deskripsi {
            color: #64748b;
            font-size: 13px;
            margin-bottom: 20px;
        }

        a.kembali {
            display: inline-block;
            color: #2563eb;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 15px;
        }

        a.kembali:hover {
            text-decoration: underline;
        }

        .error {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 10px;
            border-radius: 5px;
            font-size: 13px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 10px 0;
            font-size: 14px;
            vertical-align: middle;
        }

        input[type="text"] {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 5px;
            font-size: 14px;
            outline: none;
            box-sizing: border-box;
        }

        input:focus {
            border-color: #2563eb;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 15px;
        }

        button {
            background-color: #2563eb;
            color: white;
            border: none;
            padding: 10px 18px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #1d4ed8;
        }

        .btn-batal {
            color: #64748b;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-batal:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Data Siswa</h2>
    <p class="deskripsi">Perbarui informasi NIS, nama, atau kelas siswa di bawah ini.</p>

    <a href="tampilSiswa.php" class="kembali">&laquo; Kembali ke Data Siswa</a>

    <?php if (!empty($error)) : ?>
        <div class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <table>
            <tr>
                <td width="30%">NIS</td>
                <td width="2%">:</td>
                <td>
                    <input type="text" name="nis" value="<?= htmlspecialchars($siswa['nis'], ENT_QUOTES, 'UTF-8'); ?>" required>
                </td>
            </tr>
            <tr>
                <td>Nama Siswa</td>
                <td>:</td>
                <td>
                    <input type="text" name="nama" value="<?= htmlspecialchars($siswa['nama'], ENT_QUOTES, 'UTF-8'); ?>" required>
                </td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td>
                    <input type="text" name="kelas" value="<?= htmlspecialchars($siswa['kelas'], ENT_QUOTES, 'UTF-8'); ?>" required>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <div class="actions">
                        <button type="submit" name="ubah">Simpan Perubahan</button>
                        <a href="tampilSiswa.php" class="btn-batal">Batal</a>
                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>
