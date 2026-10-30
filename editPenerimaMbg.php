<?php
include 'koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'] ?? '';

if ($id == '') {
    header("Location: PenerimaMBG.php");
    exit;
}

// Ambil data penerima berdasarkan id_mbg
$query_data = mysqli_query($koneksi, "SELECT * FROM tb_mbg WHERE id_mbg = '$id'");
$data = mysqli_fetch_assoc($query_data);

// Jika data tidak ditemukan
if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='PenerimaMBG.php';</script>";
    exit;
}

$pesan = "";

// Jika tombol update ditekan
if (isset($_POST['update'])) {
    $nama_siswa    = trim($_POST['nama_siswa'] ?? '');
    $tanggal       = $_POST['tanggal'] ?? '';
    $status_terima = trim($_POST['status_terima'] ?? '');

    if ($nama_siswa == '' || $tanggal == '' || $status_terima == '') {
        $pesan = "Semua kolom wajib diisi!";
    } else {
        // Update data ke tabel tb_mbg menggunakan nama_siswa
        $stmt = mysqli_prepare(
            $koneksi,
            "UPDATE tb_mbg SET nama_siswa = ?, tanggal = ?, status_terima = ? WHERE id_mbg = ?"
        );

        mysqli_stmt_bind_param($stmt, "sssi", $nama_siswa, $tanggal, $status_terima, $id);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            echo "<script>alert('Data penerima MBG berhasil diubah!'); window.location='PenerimaMBG.php';</script>";
            exit;
        } else {
            $pesan = "Gagal mengubah data: " . mysqli_stmt_error($stmt);
            mysqli_stmt_close($stmt);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Penerima MBG</title>
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

        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 5px;
            font-size: 14px;
            outline: none;
            box-sizing: border-box;
        }

        input:focus, select:focus {
            border-color: #2563eb;
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
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Penerima Makan Bergizi Gratis (MBG)</h2>
    <p class="deskripsi">Silakan perbarui data penerimaan siswa di bawah ini.</p>

    <a href="PenerimaMBG.php" class="kembali">&laquo; Kembali ke Data Penerimaan</a>

    <?php if (!empty($pesan)): ?>
        <div class="error"><?= htmlspecialchars($pesan, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <table>
            <tr>
                <td width="30%">Nama Siswa</td>
                <td width="2%">:</td>
                <td>
                    <input type="text" name="nama_siswa" value="<?= htmlspecialchars($data['nama_siswa'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                </td>
            </tr>
            <tr>
                <td>Tanggal Diterima</td>
                <td>:</td>
                <td>
                    <input type="date" name="tanggal" value="<?= htmlspecialchars($data['tanggal'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                </td>
            </tr>
            <tr>
                <td>Status Terima</td>
                <td>:</td>
                <td>
                    <select name="status_terima" required>
                        <option value="diterima" <?= (($data['status_terima'] ?? '') == 'diterima') ? 'selected' : '' ?>>Diterima</option>
                        <option value="tidak diterima" <?= (($data['status_terima'] ?? '') == 'tidak diterima') ? 'selected' : '' ?>>Tidak Diterima</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td style="padding-top: 15px;">
                    <button type="submit" name="update">Simpan Perubahan</button>
                </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>
