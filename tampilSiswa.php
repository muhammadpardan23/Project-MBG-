<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
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
        }

        tbody tr:hover {
            background-color: #f8fafc;
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
    <h2>Data Siswa</h2>
    <p class="deskripsi">Daftar seluruh data siswa yang terdaftar dalam sistem.</p>

    <div class="menu">
        <a href="index.php">&laquo; Menu Utama</a>
        <a href="tambahSiswa.php">+ Tambah Siswa Baru</a>
    </div>

    <table>
        <thead>
            <tr>
                <th width="8%">No</th>
                <th width="20%">NIS</th>
                <th>Nama Siswa</th>
                <th width="18%">Kelas</th>         
                <th width="18%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM tb_siswa");
            
            if (mysqli_num_rows($query) > 0) {
                while ($data = mysqli_fetch_assoc($query)) :
                    $id = $data['id_siswa'];
                    $nis = $data['nis'];
                    $nama = $data['nama'];
                    $kelas = $data['kelas'];
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($nis); ?></td>
                <td><?php echo htmlspecialchars($nama); ?></td>
                <td><?php echo htmlspecialchars($kelas); ?></td>
                <td class="aksi">
                    <a href="editSiswa.php?id=<?php echo $id; ?>">Edit</a> | 
                    <a href="hapusSiswa.php?id=<?php echo $id; ?>" class="hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php 
                endwhile; 
            } else {
                echo '<tr><td colspan="5" class="kosong">Belum ada data siswa.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
