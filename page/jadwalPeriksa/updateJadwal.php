<?php
include '../../koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $id = $_POST['id'];
    $aktif = $_POST['aktif'];
    $idDokter = $_SESSION['id'];

    // Reset semua status 'aktif' menjadi 'N' untuk dokter tertentu
    $resetAktifQuery = "UPDATE jadwal_periksa SET aktif='N' WHERE id_dokter='$idDokter'";
    if (!mysqli_query($mysqli, $resetAktifQuery)) {
        echo "Error: " . mysqli_error($mysqli);
        exit();
    }

    // Update hanya kolom 'aktif' untuk jadwal tertentu
    $setAktifQuery = "UPDATE jadwal_periksa SET aktif='$aktif' WHERE id='$id'";
    if (mysqli_query($mysqli, $setAktifQuery)) {
        // Jika berhasil, tampilkan pesan sukses dan kembali ke halaman utama
        echo '<script>';
        echo 'alert("Status berhasil diubah!");';
        echo 'window.location.href = "../../jadwalPeriksa.php";';
        echo '</script>';
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo "Error: " . $setAktifQuery . "<br>" . mysqli_error($mysqli);
    }
}

// Tutup koneksi
mysqli_close($mysqli);
?>
