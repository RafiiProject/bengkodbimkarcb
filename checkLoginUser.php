<?php
session_start();
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password']; // Password asli, belum di-hash

    // Cek login sebagai admin
    if ($username == "admin" && md5($password) == md5("admin")) {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = md5($password);
        $_SESSION['akses'] = "admin";

        header("location:dashboard_admin.php");
        exit();
    } else {
        // Cek login sebagai dokter
        $query = "SELECT * FROM dokter WHERE nama = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();

            // Verifikasi password dengan password_verify
            if (password_verify($password, $data['password'])) {
                $_SESSION['id'] = $data['id'];
                $_SESSION['username'] = $data['nama'];
                $_SESSION['password'] = $data['password']; // Password yang sudah di-hash
                $_SESSION['id_poli'] = $data['id_poli'];
                $_SESSION['akses'] = "dokter";

                header("location:dashboard_dokter.php");
                exit();
            } else {
                echo '<script>alert("Password salah");location.href="loginUser.php";</script>';
                exit();
            }
        } else {
            echo '<script>alert("Username tidak ditemukan");location.href="loginUser.php";</script>';
            exit();
        }
    }
}
?>
