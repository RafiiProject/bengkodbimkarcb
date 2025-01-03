<?php
// Menghubungkan ke database
include '../../koneksi.php'; // Sesuaikan dengan jalur yang benar

// Memeriksa jika request menggunakan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama_poli = $_POST["nama_poli"];
    $keterangan = $_POST["keterangan"];

    // Validasi data input
    if (empty($nama_poli) || empty($keterangan)) {
        echo '<script>alert("Nama Poli dan Keterangan harus diisi!"); window.location.href = "../../poli.php";</script>';
        exit();
    }

    // Cek apakah poli sudah ada
    $check = "SELECT * FROM poli WHERE nama_poli = ?";
    $stmt = $mysqli->prepare($check);
    $stmt->bind_param("s", $nama_poli);
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika poli sudah ada
    if (mysqli_num_rows($result) > 0) {
        echo '<script>alert("Poli sudah ada!"); window.location.href = "../../poli.php";</script>';
    } else {
        // Query untuk menambahkan data poli
        $query = "INSERT INTO poli (nama_poli, keterangan) VALUES (?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ss", $nama_poli, $keterangan);

        // Eksekusi query dan tangani hasilnya
        if ($stmt->execute()) {
            // Jika berhasil, tampilkan alert dan redirect
            echo '<script>';
            echo 'alert("Data Poli berhasil ditambahkan!");';
            echo 'window.location.href = "../../poli.php";';
            echo '</script>';
        } else {
            // Jika terjadi kesalahan, tampilkan error
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Tutup koneksi
mysqli_close($mysqli);
?>
