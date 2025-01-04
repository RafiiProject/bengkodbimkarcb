<?php
require 'koneksi.php';

$idDaftarPoli = $_GET['id'];

// Ambil data pasien dan pemeriksaan
$query = "
    SELECT 
        pasien.nama AS nama_pasien,
        periksa.tgl_periksa,
        periksa.biaya_periksa,
        periksa.status_pembayaran,
        obat.nama_obat,
        obat.harga 
    FROM periksa
    INNER JOIN daftar_poli ON periksa.id_daftar_poli = daftar_poli.id
    INNER JOIN pasien ON daftar_poli.id_pasien = pasien.id
    LEFT JOIN detail_periksa ON periksa.id = detail_periksa.id_periksa
    LEFT JOIN obat ON detail_periksa.id_obat = obat.id
    WHERE daftar_poli.id = '$idDaftarPoli'
";
$result = mysqli_query($mysqli, $query);

// Data utama
$data = mysqli_fetch_assoc($result);

// Reset pointer untuk obat
mysqli_data_seek($result, 0);
$totalObat = 0;
$obatList = [];
while ($row = mysqli_fetch_assoc($result)) {
    $totalObat += $row['harga'];
    $obatList[] = $row; // Simpan data obat untuk penggunaan di JavaScript
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Struk Pemeriksaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 400px;
            margin: auto;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 20px;
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f4f4f4;
        }
        .total {
            font-size: 16px;
            font-weight: bold;
            margin-top: 15px;
            text-align: right;
        }
        .btn {
            display: block;
            width: 100%;
            text-align: center;
            margin-top: 20px;
        }
        .btn button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn button:hover {
            background-color: #218838;
        }
        .btn-back {
            margin-top: 10px;
        }
        .btn-back button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-back button:hover {
            background-color: #0056b3;
        }
        @media print {
            .btn, .btn-back {
                display: none;
            }
        }
    </style>
    <script>
        function updateHarga() {
            let totalHargaObat = 0;
            const obatRows = document.querySelectorAll('.obat-row');

            obatRows.forEach(row => {
                const harga = parseInt(row.getAttribute('data-harga')) || 0;
                totalHargaObat += harga;
            });

            const biayaPeriksa = 150000; // Biaya pemeriksaan tetap
            const totalHarga = biayaPeriksa + totalHargaObat;

            document.getElementById('total-harga').textContent = 'Rp' + totalHarga.toLocaleString('id-ID');
            document.getElementById('biaya-pemeriksaan').textContent = 'Rp' + biayaPeriksa.toLocaleString('id-ID');
        }

        window.onload = updateHarga; // Jalankan perhitungan saat halaman selesai dimuat
    </script>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Struk Pemeriksaan</h1>
        </div>
        <p><strong>Nama Pasien:</strong> <?php echo $data['nama_pasien']; ?></p>
        <p><strong>Tanggal Periksa:</strong> <?php echo $data['tgl_periksa']; ?></p>
        <p><strong>Status Pembayaran:</strong> <?php echo $data['status_pembayaran']; ?></p>

        <h3>Detail Obat</h3>
        <table>
            <thead>
                <tr>
                    <th>Nama Obat</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($obatList as $obat) { ?>
                <tr class="obat-row" data-harga="<?php echo $obat['harga']; ?>">
                    <td><?php echo $obat['nama_obat']; ?></td>
                    <td>Rp<?php echo number_format($obat['harga'], 0, ',', '.'); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <p><strong>Biaya Pemeriksaan:</strong> <span id="biaya-pemeriksaan">Rp<?php echo number_format(150000, 0, ',', '.'); ?></span></p>
        <div class="total">Total Biaya: <span id="total-harga">Rp<?php echo number_format(150000 + $totalObat, 0, ',', '.'); ?></span></div>
        <div class="btn">
            <button onclick="window.print()">Cetak</button>
        </div>
        <div class="btn-back">
            <button onclick="window.location.href='javascript:history.back()';">Kembali</button>
        </div>
    </div>
</body>
</html>
