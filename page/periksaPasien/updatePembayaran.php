<?php
require '../../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idDaftarPoli = $_POST['id'];

    // Update status pembayaran
    $query = "UPDATE periksa SET status_pembayaran = 'Lunas' WHERE id_daftar_poli = '$idDaftarPoli'";
    $result = mysqli_query($mysqli, $query);

    if ($result) {
        echo '<script>alert("Pembayaran berhasil diselesaikan.");window.location.href="../../periksaPasien.php";</script>';
    } else {
        echo '<script>alert("Terjadi kesalahan dalam pembayaran.");window.location.href="../../periksaPasien.php";</script>';
    }
}
?>
