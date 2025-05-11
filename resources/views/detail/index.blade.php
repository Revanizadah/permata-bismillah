<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pemesanan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0;
        }
        .form-group {
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        label {
            font-weight: bold;
        }
        .value {
            font-size: 1.1rem;
            color: #333;
        }
        .btn {
            background-color: #1d3c6e;
            color: white;
            padding: 10px 15px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            text-align: center;
            display: inline-block;
            cursor: pointer;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #575757;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h2>Dalam Proses</h2>
            <p>Selamat Datang di Permata Futsal dan Badminton</p>
            <p>Revani Zadah Pratiwi</p>
        </div>

        <div class="form-group">
            <label for="nama">Nama</label>
        </div>

        <div class="form-group">
            <label for="lapangan">Lapangan</label>
        </div>

        <div class="form-group">
            <label for="tanggal">Tanggal</label>
        </div>

        <div class="form-group">
            <label for="jam">Jam</label>
        </div>

        <div class="form-group" style="text-align: center;">
            <a href="{{ route('reservasi.index') }}" class="btn">Kembali</a>
        </div>
    </div>

</body>
</html>
