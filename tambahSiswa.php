<?php
include 'koneksi.php';

// Cek apakah tombol Simpan sudah ditekan
if (isset($_POST['submit'])) {
    $nis     = trim($_POST['nis']);
    $nama    = trim($_POST['nama_siswa']);
    $kelas   = $_POST['kelas'];

    // Validasi: NIS harus angka, Nama harus huruf & spasi
    if (!ctype_digit($nis)) {
        echo "<script>alert('Gagal! NIS harus berupa angka.'); window.history.back();</script>";
        exit;
    } elseif (!preg_match("/^[a-zA-Z\s]*$/", $nama)) {
        echo "<script>alert('Gagal! Nama siswa hanya boleh berisi huruf.'); window.history.back();</script>";
        exit;
    }

    // Query disesuaikan dengan nama tabel 'tb_siswa' dan kolom huruf kecil
    $query = "INSERT INTO tb_siswa (nis, nama, kelas) VALUES ('$nis', '$nama', '$kelas')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Data siswa berhasil ditambahkan!'); window.location='tampilSiswa.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data ke database: " . mysqli_error($koneksi) . "'); window.history.back();</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa Baru</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 10px 0;
            font-size: 14px;
            vertical-align: middle;
        }

        input[type="text"], select {
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
    <script>
        // Validasi client-side
        function validateForm() {
            let nis = document.getElementById("nis").value;
            let nama = document.getElementById("nama_siswa").value;

            let angkaRegex = /^[0-9]+$/;
            if (!angkaRegex.test(nis)) {
                alert("NIS harus berupa angka (tidak boleh ada huruf atau simbol)!");
                return false;
            }

            let hurufRegex = /^[a-zA-Z\s]+$/;
            if (!hurufRegex.test(nama)) {
                alert("Nama siswa hanya boleh berisi huruf!");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>

<div class="container">
    <h2>Tambah Data Siswa Baru</h2>
    <p class="deskripsi">Silakan masukkan informasi NIS, nama siswa, dan kelas dengan benar.</p>

    <a href="tampilSiswa.php" class="kembali">&laquo; Kembali ke Data Siswa</a>

    <!-- Form Tambah Siswa -->
    <form action="tambahSiswa.php" method="POST" onsubmit="return validateForm()">
        <table>
            <tr>
                <td width="30%">NIS</td>
                <td width="2%">:</td>
                <td>
                    <input type="text" id="nis" name="nis" placeholder="Contoh: 12345" required>
                </td>
            </tr>
            <tr>
                <td>Nama Siswa</td>
                <td>:</td>
                <td>
                    <input type="text" id="nama_siswa" name="nama_siswa" placeholder="Contoh: Budi Santoso" required>
                </td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td>
                    <select id="kelas" name="kelas" required>
                        <option value="">-- Pilih Kelas --</option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td style="padding-top: 15px;">
                    <button type="submit" name="submit">+ Simpan Siswa</button>
                </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>
