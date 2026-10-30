<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Utama</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f5f9;
            margin: 0;
            padding: 50px;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 400px;
            background: #ffffff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        h2 {
            text-align: center;
            color: #1e293b;
            margin-bottom: 20px;
            font-size: 22px;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            margin-bottom: 12px;
        }

        a {
            display: block;
            text-decoration: none;
            color: #ffffff;
            padding: 12px 15px;
            background: #2563eb; /* Warna biru standar yang rapi */
            text-align: center;
            border-radius: 5px;
            font-weight: bold;
            font-size: 14px;
            transition: background 0.2s;
        }

        a:hover {
            background: #1d4ed8; /* Biru lebih gelap saat disorot */
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Menu Utama</h2>

        <ul>
            <li><a href="tampilSiswa.php">Data Siswa</a></li>
            <li><a href="menuMbg.php">Menu MBG</a></li>
            <li><a href="penerimaMbg.php">Penerima MBG</a></li>
        </ul>
    </div>

</body>
</html>
