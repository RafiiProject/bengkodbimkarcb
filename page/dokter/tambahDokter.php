<?php
require '../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $no_hp = $_POST["no_hp"];
    $poli = $_POST["poli"];
    $hashed_password = password_hash($nama, PASSWORD_DEFAULT); // Hash password menggunakan password_hash

    // Validasi input tidak kosong
    if (empty($nama) || empty($alamat) || empty($no_hp) || empty($poli)) {
        echo '<script>alert("Semua kolom harus diisi!"); window.location.href = "../../dokter.php";</script>';
        exit();
    }

    // Query untuk menambahkan data dokter
    $query = "INSERT INTO dokter (nama, password, alamat, no_hp, id_poli) VALUES (?, ?, ?, ?, ?)";

    // Persiapkan query menggunakan prepared statement untuk menghindari SQL injection
    if ($stmt = $mysqli->prepare($query)) {
        // Bind parameter ke prepared statement
        $stmt->bind_param("ssssi", $nama, $hashed_password, $alamat, $no_hp, $poli);

        // Eksekusi query
        if ($stmt->execute()) {
            echo '<script>';
            echo 'alert("Data dokter berhasil ditambahkan!");';
            echo 'window.location.href = "../../dokter.php";';
            echo '</script>';
            exit();
        } else {
            // Jika query gagal, tampilkan pesan error
            echo "Error executing query: " . $stmt->error;
        }

        // Tutup statement
        $stmt->close();
    } else {
        // Jika query gagal dipersiapkan, tampilkan pesan error
        echo "Error preparing statement: " . $mysqli->error;
    }
}

// Tutup koneksi
mysqli_close($mysqli);
?>
