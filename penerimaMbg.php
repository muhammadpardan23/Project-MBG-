<?php
include 'koneksi.php';

$sql = "SELECT * FROM tb_mbg ORDER BY tanggal DESC";

$data = mysqli_query($koneksi, $sql);

if (!$data) {
    die("Query error: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penerimaan MBG</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f5f9;
            margin: 0;
            padding: 30px;
            color: #334155;
        }

        .container {
            max-width: 900px;
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

        .menu {
            margin-bottom: 20px;
        }

        .menu a {
            display: inline-block;
            color: #2563eb;
            text-decoration: none;
            font-size: 14px;
            margin-right: 15px;
            font-weight: bold;
        }

        .menu a:hover {
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background-color: #2563eb;
            color: white;
            padding: 12px;
            text-align: left;
            font-size: 14px;
        }

        td {
            padding: 11px 12px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
            vertical-align: middle;
        }

        tbody tr:hover {
            background-color: #f8fafc;
        }

        .status {
            display: inline-block;
            padding: 4px 10px;
            background-color: #dbeafe;
            color: #1d4ed8;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .aksi a {
            color: #2563eb;
            text-decoration: none;
            margin-right: 5px;
        }

        .aksi a:hover {
            text-decoration: underline;
        }

        .aksi a.hapus {
            color: #dc2626;
        }

        .kosong {
            text-align: center;
            padding: 20px;
            color: #64748b;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Data Penerimaan MBG</h2>
    <p class="deskripsi">Daftar penerimaan makanan bergizi gratis siswa.</p>

    <div class="menu">
        <a href="index.php">&laquo; Menu Utama</a>
        <a href="tambahPenerimaMbg.php">+ Tambah Penerimaan MBG</a>
    </div>

    <table>
        <thead>
            <tr>
                <th width="8%">No</th>
                <th>Nama Siswa</th>
                <th width="22%">Tanggal</th>
                <th width="18%">Status</th>
                <th width="18%">Aksi</th>
            </tr>
        </thead>

        <tbody>
        <?php
        $no = 1;

        if (mysqli_num_rows($data) > 0) {
            while ($row = mysqli_fetch_assoc($data)) {
        ?>

            <tr>
                <td><?= $no++ ?></td>

                <td>
                    <?= htmlspecialchars($row['nama_siswa']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($row['tanggal']) ?>
                </td>

                <td>
                    <span class="status">
                        <?= htmlspecialchars($row['status_terima']) ?>
                    </span>
                </td>

                <td class="aksi">
                    <a href="editPenerimaMbg.php?id=<?= (int)$row['id_mbg'] ?>">
                        Edit
                    </a> | 
                    <a class="hapus"
                       href="hapusPenerimaMbg.php?id=<?= (int)$row['id_mbg'] ?>"
                       onclick="return confirm('Yakin ingin menghapus data ini?')">
                        Hapus
                    </a>
                </td>
            </tr>

        <?php
            }
        } else {
        ?>

            <tr>
                <td colspan="5" class="kosong">
                    Belum ada data penerimaan MBG.
                </td>
            </tr>

        <?php } ?>
        </tbody>
    </table>

</div>

</body>
</html>
