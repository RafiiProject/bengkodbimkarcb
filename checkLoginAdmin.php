<?php
// Memulai sesi jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Menghubungkan ke database
include 'koneksi.php';

// Mendefinisikan variabel error untuk pesan kesalahan
$error = "";

// Mengecek apakah request berasal dari metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil input dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi input
    if (!empty($username) && !empty($password)) {
        // Menggunakan prepared statement untuk menghindari SQL injection
        $stmt = $mysqli->prepare("SELECT * FROM user WHERE username = ? AND role = 'admin'");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Memeriksa apakah user ditemukan
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            // Memeriksa apakah password cocok
            if (password_verify($password, $row['password'])) {
                // Menyimpan data user ke session
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_id'] = $row['id_user'];
                $_SESSION['role'] = $row['role'];

                // Redirect ke halaman admin
                header("Location: dashboard_admin.php");
                exit;
            } else {
                $error = "Password salah.";
            }
        } else {
            $error = "Username tidak ditemukan atau bukan admin.";
        }
    } else {
        $error = "Username dan password tidak boleh kosong.";
    }
}

// Jika terjadi kesalahan, redirect kembali ke halaman login dengan pesan error
if (!empty($error)) {
    $_SESSION['error'] = $error;
    header("Location: ../../loginAdmin.php");
    exit;
}
?>
