<?php
include 'koneksi.php';

// Cek apakah tombol Simpan sudah ditekan
if (isset($_POST['submit'])) {
    $tanggal   = trim($_POST['tanggal']);
    $nama_menu = trim($_POST['nama_menu']);

    // Validasi sederhana: input tidak boleh kosong
    if (empty($tanggal) || empty($nama_menu)) {
        echo "<script>alert('Gagal! Semua field harus diisi.'); window.history.back();</script>";
        exit;
    }

    // Query untuk menyimpan data ke tabel 'tb_menu_mbg'
    $query = "INSERT INTO tb_menu_mbg (tanggal, nama_menu) VALUES ('$tanggal', '$nama_menu')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Data menu MBG berhasil ditambahkan!'); window.location='menuMbg.php';</script>";
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
    <title>Tambah Menu MBG</title>
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

        input[type="text"],
        input[type="date"] {
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
            let tanggal = document.getElementById("tanggal").value;
            let namaMenu = document.getElementById("nama_menu").value;

            if (tanggal === "" || namaMenu.trim() === "") {
                alert("Harap isi semua kolom!");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>

<div class="container">
    <h2>Tambah Data Menu MBG</h2>
    <p class="deskripsi">Silakan masukkan data menu makanan bergizi gratis baru di bawah ini.</p>

    <a href="menuMbg.php" class="kembali">&laquo; Kembali ke Data Menu MBG</a>

    <!-- Form Tambah Menu MBG -->
    <form action="" method="POST" onsubmit="return validateForm()">
        <table>
            <tr>
                <td width="30%">Tanggal</td>
                <td width="2%">:</td>
                <td>
                    <input type="date" id="tanggal" name="tanggal" required>
                </td>
            </tr>
            <tr>
                <td>Nama Menu</td>
                <td>:</td>
                <td>
                    <input type="text" id="nama_menu" name="nama_menu" placeholder="Contoh: Ayam serundeng" required>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td style="padding-top: 15px;">
                    <button type="submit" name="submit">+ Simpan Menu</button>
                </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>
