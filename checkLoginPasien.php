<?php
    session_start();
    require 'koneksi.php';

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        // Cek apakah username dan password cocok di database
        $query = "SELECT * FROM pasien WHERE nama = '$username' && password = '$password'";
        $result = mysqli_query($mysqli, $query);

        if (mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);

            // Jika login berhasil, simpan data ke sesi
            $_SESSION['id'] = $data['id'];
            $_SESSION['username'] = $data['nama'];
            $_SESSION['password'] = $data['password'];
            $_SESSION['no_rm'] = $data['no_rm'];
            $_SESSION['akses'] = "pasien";

            header("location:dashboard_pasien.php");
        } else {
            // Jika tidak ada data yang cocok, kirimkan alert dan kembali ke halaman login
            echo '<script>alert("Email atau password salah");location.href="loginPasien.php";</script>';
        }
    }
?>
